<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Pusher\Pusher;

class PrivateController extends Controller
{


    public function showcontacts(){
        $friends = DB::table('friendlist')
        ->select('users.id' ,'users.firstname','users.lastname', 'users.age', 'users.gender')
        ->rightJoin('users', 'friendlist.friendID', '=', 'users.id')
        ->where('userID', '=', Auth::user()->id)
        ->get();

        return view('Chat.private_chat' , ['friends' => $friends]);

    }


    public function message($friendid){

        $userid = Auth::user()->id;
        //getting the message from each user

        Message::where(['from' => $friendid, 'to' => $userid])->update(['is_read' => 0]);
        //use the query function use both friendid and user id
        $messages = Message::where(function ($query) use ($friendid, $userid){
            $query->where('from', $userid)->where('to', $friendid); //message sent
        })->orWhere(function($query) use($friendid, $userid){
            $query->where('from', $friendid)->where('to', $userid); //message received
        })->get();

        return view('private')->with('messages' , $messages);

    }

    public function sendmessage(Request $request){

        $from = Auth::user()->id;
        $to = $request->receiverid;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->created_at = DB::raw('NOW()');
        $data->save();

        $options = array(
            'cluster' => 'ap1'
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // send the message as the [enter] button is pressed
        $pusher->trigger('my-channel', 'message-sent' , $data);
    }

}
