<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;
use App\GroupMessage;
use App\Member;
use Pusher\Pusher;

class PublicController extends Controller
{
    //
    public function showrooms(){
        $rooms = DB::table('members')
        ->select('room.id' ,'room.name','room.age', 'room.gender', 'room.topic')
        ->rightJoin('room', 'members.roomID', '=', 'room.id')
        ->where('memberID', '=', Auth::user()->id)
        ->get();

        return view('Chat.public_chat' , ['rooms' => $rooms]);
    }

    public function message($id){
        $userid = Auth::user()->id;
        $messages = GroupMessage::where('roomID', '=', $id)->get();
        GroupMessage::where(['from' => $userid, 'roomID' => $id])->update(['updated_at' => DB::raw("NOW()")]);
        return view('public', compact('messages'));

        /*
        user = User::where('id', '=', $messages->from)->get();
        $memberid = DB::table('groupmessage')
        ->select('from')
        ->leftJoin('room', 'groupmessage.roomID', '=', 'room.id', '=', $id)
        ->where('from', '!=', $userid)
        ->pluck('from');

        //getting the message from each user
        GroupMessage::where(['roomID' => $id, 'from' => $userid])->orWhere(['roomID' => $id, 'from' => $memberid]);

        // use the query function use both room id and user id
        $messages = GroupMessage::where(function ($query) use ($id, $userid){
            $query->where('from', $userid)->where('roomID', $id); //message sent
        })->orWhere(function($query) use($memberid , $id){
            $query->where('roomID', $id)->where('from', $memberid); //message received
        })->get();
        dd($messages, $memberid);
        //return view('public', compact('user'))->with('messages' , $messages);
        */

    }

    public function getname($id){
        $roomname = DB::table('room')->select('name')->where('id' , $id)->get();
        echo json_encode($roomname);
        exit;
    }

    public function memberlist($id){
        $memberlist = DB::table('users')
        ->select('firstname' , 'lastname' , 'age')
        ->leftJoin('members', 'users.id', '=', 'members.memberID')
        ->where('members.roomID', '=', $id)
        ->get();
        return compact('memberlist');
    }

    public function leaveRoom($id){
        $userid = Auth::user()->id;
        DB::table('members')->where('memberID' , $userid)->where('roomID' , $id)->delete();
        return redirect()->back() ->with('LeaveRoom' , "you have left the room");
    }

    public function sendmessage(Request $request){
        $from = Auth::user()->id;
        $id = $request->roomid;
        $message = $request->message;

        $data = new groupmessage();
        $data->from = $from;
        $data->roomID = $id;
        $data->message = $message;
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

        $data = ['from' => $from, 'roomID' => $id]; // send the message as the [enter] button is pressed
        $pusher->trigger('my-channel', 'message-sent' , $data);
    }

}
