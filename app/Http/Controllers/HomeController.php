<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Room;
use App\Member;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function join($id)
    {
        $room = Room::find($id);
        $name = $room->name;

        $member = new Member();
        $member->roomID = $id;
        $member->memberID = Auth::user()->id;
        $flag = false;

        $roomlist = DB::table('members')->select('memberID')->where('roomID' , $member->roomID )->get();
        for($n = 0 ; $n < count($roomlist) ; $n++){
            if($roomlist[$n]->memberID == Auth::user()->id){
                return redirect()->back()->with('fails' , 'You have joined this room');
            }
        }

        if($room->gender != "All"){
            if($room->gender != Auth::user()->gender){
                return redirect()->back()->with('fails' ,  'for ' . $room->gender.' only ');
            }else{
                $flag = true;
            }
        }

        if($room->age > Auth::user()->age){
            return redirect()->back()->with('fails' , 'You are not old enough');
        }else{
            $flag = true;
        }

        $totalmember = DB::table('members')->where('roomID' , $room->id)->count('memberID');
        if($totalmember >= $room->max){
            return redirect()->back()->with('fails' ,  $name . ' is full ');
        }else{
           $flag = true;
        }

        if($flag == true){
            $member->save();
            return redirect()->back()->with('joined' , 'You Have Succesfully Joined ' . $name);
        }
    }

    public function searchroom(Request $request){
        $find = $request->input('searchroom');
        $rooms = DB::table('room')->where('name', $find)->get();
        return view('home', ['rooms' => $rooms]);
    }
}
