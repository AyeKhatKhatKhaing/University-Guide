<?php

namespace App\Http\Controllers;

use App\StudentMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('id','!=',Auth::id())->get();
        $users=DB::select("select users.id,users.name,users.photo,users.email, count(is_read) as unread
        from users LEFT JOIN student_messages ON users.id=student_messages.from and student_messages.is_read=0 and student_messages.to=".Auth::id()."
        where users.id != ".Auth::id()."
        group by users.id,users.name,users.photo,users.email order by users.name
        ");

        return view('stu-message.index',compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentMessage  $studentMessage
     * @return \Illuminate\Http\Response
     */
    public function show(StudentMessage $studentMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentMessage  $studentMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentMessage $studentMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentMessage  $studentMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentMessage $studentMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentMessage  $studentMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentMessage $studentMessage)
    {
        //
    }
}
