<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Rules\MatchOldPassword;
use App\University;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;
class UniversityViewController extends Controller
{
    public function index(){
        $universities=University::when(isset(request()->search),function ($q){
            $search=request()->search;
            return $q->where("name","like","%$search%")->orwhere("description","like","%$search%")->orwhere("location","like","%$search%")->orwhere("mark_one","like","%$search%")->orwhere("mark_two","like","%$search%");
        })->latest('id')->paginate(10);
        return view('Uni_View.home',compact('universities'));
    }

    public function currentPlace(){
        $ip=request()->ip();
        $data=Location::get('192.168.88.58');
        dd($data);
    }


    public function show($id){
        $university=University::find($id);
        return view('Uni_View.detail',compact('university'));
    }
    public function annView(){

        $anns=Announcement::latest('id')->get();
        foreach ($anns as $a){
            $a->isRead='1';
            $a->update();
        }
        if(count($anns)>0){
            $user=User::find(Auth::id());
            $user->last_viewed_announcement=$anns[0]->id;
            $user->update();
        }
        return view('Uni_View.announcementView',compact('anns'));
    }

    public function profileHome(){
        $user=User::find(Auth::id());
        return view('Uni_View.profile',compact('user'));
    }

    public function profileEdit(){
        $user=User::find(Auth::id());
        return view('Uni_View.profileEdit',compact('user'));
    }

    public function profileUpdate(Request $request){
        $request->validate([
            "pname"=>"required",
            "photo"=>"required",
            'pcurrentPassword' => ['required', new MatchOldPassword()],
            'confirmPassword' => ['same:newPassword'],
            "phone"=>"required",
            "address"=>"required"
        ]);
        $dir="public/profile/";

        Storage::delete($dir.Auth::user()->photo);

        $newName = uniqid()."_photo.".$request->file("photo")->getClientOriginalExtension();
        $request->file("photo")->storeAs($dir,$newName);

        $user = User::find(Auth::id());
        $user->photo = $newName;
        $user->name=$request->pname;
        if($request->newPassword){
            $user->password=Hash::make($request->newPassword);
        }
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->update();
        return redirect()->route("uniView.profile")->with("toast",["icon"=>"success","title"=>"Profile Information Changed"]);
    }
}
