<?php

namespace App\Http\Controllers;

use App\Post;
use App\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::when(isset(request()->search),function ($q){
            $search=request()->search;
            return $q->where("owner","like","%$search%");
        })->latest('id')->paginate(10);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "description"=>'required',
        ]);
        $post=new Post();
        $post->description=$request->description;
        $post->user_id=Auth::user()->id;
        $post->owner=Auth::user()->name;
        $post->save();
        return redirect()->route('post.index')->with("toast",["icon"=>"success","title"=>"Post Added"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "description"=>'required',
        ]);
        $post->description=$request->description;
        $post->update();
        return redirect()->route('post.index')->with("toast",["icon"=>"success","title"=>"Post Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index',['page'=>request()->page])->with("toast",["icon"=>"success","title"=>"Post Deleted"]);

    }
}
