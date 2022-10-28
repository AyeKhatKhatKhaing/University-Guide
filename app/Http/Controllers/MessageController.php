<?php

namespace App\Http\Controllers;

use App\StudentMessage;
use http\Client\Curl\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class MessageController extends Controller
{

    public function getMessage($user_id){
        $my_id=Auth::id();

        StudentMessage::where(['from'=>$user_id,'to'=>$my_id])->update(['is_read'=>1]);

        $messages=StudentMessage::where(function ($query) use ($user_id,$my_id){
            $query->where('from',$my_id)->where('to',$user_id);
        })->orWhere(function ($query) use ($user_id,$my_id){
            $query->where('from',$user_id)->where('to',$my_id);
        })->get();
        return view('stu-message.messages',compact(['messages']));
    }

    public function sendMessage(Request $request)
    {
        $from=Auth::id();
        $to=$request->receiver_id;
        $message=$request->message;

        $data=new StudentMessage();
        $data->from=$from;
        $data->to=$to;
        $data->message=$message;
        $data->is_read=0;
        $data->save();

        $options =array (
        'cluster' => 'ap1',
        'useTLS' => true
        );

        $pusher=new Pusher(
            'e3ac405deb7cb18a8b6b',
            '4b08a663bb5b6f3c4934',
            '1496341',
            $options
        );

        $data=['from'=>$from,'to'=>$to];
        $pusher->trigger('my-channel','my-event',$data);
    }
}
