<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        return view("user-profile.profile");
    }

    public function editPhoto(){
        return view('user-profile.edit-photo');
    }

    public function editPassword(){
        return view('user-profile.edit-password');
    }

    public function updateInfo(Request $request){
        $request->validate([
            "phone"=>'required',
            "address"=>'required|min:5'
        ]);
        $currentUser=User::find(Auth::user()->id);
        $currentUser->phone=$request->phone;
        $currentUser->address=$request->address;
        $currentUser->save();
        return redirect()->back();
    }

    public function editInfo(){
        return view('user-profile.edit-info');
    }

    public function changePassword(Request $request){

        $request->validate([
            'current_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required','min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Auth::logout();
        return redirect()->route('login')->with("toast",["icon"=>"success","title"=>"Password Changed"]);

    }


    public function changePhoto(Request $request){
        $request->validate([
            "photo" => "required|mimetypes:image/jpeg,image/png,image/jpg|max:2500"
        ]);
        $dir="public/profile/";

        Storage::delete($dir.Auth::user()->photo);

        $newName = uniqid()."_photo.".$request->file("photo")->getClientOriginalExtension();
        $request->file("photo")->storeAs($dir,$newName);

        $user = User::find(Auth::id());
        $user->photo = $newName;
        $user->update();

        return redirect()->route("profile.edit.photo")->with("toast",["icon"=>"success","title"=>"Profile Photo Changed"]);

    }

    public function changeInfo(Request $request){

        $request->validate([
            'new_name' => ['required'],
            'new_email' => ['required'],
            'new_phone' => ['required'],
            'new_address' => ['required'],
        ]);

        $user=User::find(Auth::user()->id);
        $user->name=$request->new_name;
        $user->email=$request->new_email;
        $user->phone=$request->new_phone;
        $user->address=$request->new_address;
        $user->update();
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Information Updated"]);
    }

}
