<?php

namespace App\Http\Controllers;

use App\University;
use App\User;
use Illuminate\Http\Request;

class UserManagerController extends Controller
{
    public function index(){
        $users=User::where('role','1')->orderBy('id','desc')->get();
        return view('user-manager.index',compact('users'));
    }

    public function banUser(Request $request){
        $user=User::find($request->id);
        if($user->isBanned == 0){
            $user->isBanned = '1';
            $user->update();
        }
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Account Banned"]);
    }

    public function restoreUser(Request $request){
        $user=User::find($request->id);
        if($user->isBanned == 1){
            $user->isBanned = '0';
            $user->update();
        }
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Account Restored"]);
    }

    public function userUniversity(){
        $university=University::when(isset(request()->search),function ($q){
            $search=request()->search;
            return $q->where("name","like","%$search%")->orwhere("description","like","%$search%")->orwhere("location","like","%$search%")->orwhere("mark_one","like","%$search%")->orwhere("mark_two","like","%$search%");
        })->latest('id')->paginate(10);
        return view('user-manager.user_university',compact('university'));
    }

    public function userDetail($id){
        $user=User::find($id);
        return view('user-manager.detail',compact('user'));
    }
}
