<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Validator;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities=University::when(isset(request()->search),function ($q){
            $search=request()->search;
            return $q->where("name","like","%$search%")->orwhere("description","like","%$search%")->orwhere("location","like","%$search%")->orwhere("mark_one","like","%$search%")->orwhere("mark_two","like","%$search%");
        })->latest('id')->paginate(10);
        return view('university.index',compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('university.create');
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
            "photo"=>'required',
            "name"=>'required',
            "location"=>'required',
            "description"=>'required',
            "markOne"=>'required',
            "markTwo"=>'required',
        ]);
        $university=new University();
        $university->name=$request->name;
        $university->location=$request->location;
        $university->description=$request->description;
        $university->mark_one=$request->markOne;
        $university->mark_two=$request->markTwo;
        $dir="public/university/";

        $newName = uniqid()."_photo.".$request->file("photo")->getClientOriginalExtension();
        $request->file("photo")->storeAs($dir,$newName);
        $university->photo = $newName;
        $university->save();
        return redirect()->route('university.index')->with("toast",["icon"=>"success","title"=>"University added"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        return view('university.show',compact('university'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $university = University::where('id',$id)->first();
        return view('university.edit')->with(['university'=>$university]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            "photo"=>'required',
            "name"=>'required',
            "location"=>'required',
            "description"=>'required',
            "markOne"=>'required',
            "markTwo"=>'required',
        ]);

        $updateData=$this->requestUpdateData($request);
        if(isset($updateData['photo'])){
            //get old img name
            $data=University::select('photo')->where('id',$id)->first();
            $fileName= $data['photo'];

            //delete old image
            if(File::exists(public_path().'/storage/university/'.$fileName)){
                File::delete(public_path().'/storage/university/'.$fileName);
            }

            //get new image data
            $file= $request->file('photo');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/storage/university/',$fileName);
            $updateData['photo']= $fileName;

        }
        //update
        University::where('id',$id)->update($updateData);
        return redirect()->route('university.index')->with("toast",["icon"=>"success","title"=>"Update Success"]);
    }
    private function requestUpdateData($request){
        $arr= [
            'name'=>$request->name,
            'location'=>$request->location,
            'description'=>$request->description,
            'mark_one'=>$request->markOne,
            'mark_two'=>$request->markTwo,
        ];
        if(isset($request->photo)){
            $arr['photo'] =$request->photo;
        }
        return $arr;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->route('university.index',['page'=>request()->page])->with("toast",["icon"=>"success","title"=>"University Deleted"]);
    }
}
