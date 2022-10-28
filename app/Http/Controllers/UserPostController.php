<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPostController extends Controller
{
    public function store(Request $request){
        $request->validate([
            "description"=>'required',
        ]);
        $post=new Post();
        $post->description=$request->description;
        $post->user_id=Auth::user()->id;
        $post->owner=Auth::user()->name;
        $post->save();
        return redirect()->route('uniView.profile')->with("toast",["icon"=>"success","title"=>"Post Added"]);
    }

    public function edit($id)
    {
        $post=Post::find($id);
        return view('userPost.edit',compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "description"=>'required',
        ]);
        $post=Post::find($id);
        $post->description=$request->description;
        $post->update();
        return redirect()->route('uniView.profile')->with("toast",["icon"=>"success","title"=>"Post Updated"]);
    }

    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->route('uniView.profile')->with("toast",["icon"=>"success","title"=>"Post Deleted"]);

    }

    public function detail($id){
        $post=Post::find($id);
        return view('userPost.show',compact('post'));
    }

    public function addComment(Request $request){
        $request->validate([
            "description"=>'required',
        ]);
        $comment=new Comment();
        $comment->description=$request->description;
        $comment->post_id=$request->post_id;
        $comment->owner_id=$request->owner_id;
        $comment->user_id=Auth::user()->id;
        $comment->save();
        return redirect()->route('userPost.detail',$request->post_id)->with("toast",["icon"=>"success","title"=>"Comment Added"]);
    }

    public function feedIndex(){
        $posts=Post::when(isset(request()->search),function ($q){
            $search=request()->search;
            return $q->where("owner","like","%$search%");
        })->whereIn('user_id',User::select('id')->get())->latest('id')->get();
        return view('userPost.feed-index',compact('posts'));
    }

    public function userProfile($id){
        $user=User::find($id);
        return view('userPost.user-profile',compact('user'));
    }

    public function feedDetail($id){
        $post=Post::find($id);
        return view('userPost.feed-post-detail',compact('post'));
    }
}
