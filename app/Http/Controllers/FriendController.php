<?php

namespace App\Http\Controllers;

use App\Friendlist;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{

    public function show()
    {
        $users = DB::table('users')->get();
        return view('Friend.searchpeople', ['users' => $users]);
    }

    public function search(Request $request)
    {

        $find = $request->input('search');

        $users = DB::table('users')->where('firstname', $find)->orWhere('lastname', $find)->get();

        return view('Friend.searchpeople', ['users' => $users]);
    }


    public function add($id)
    {
        $user = User::Find($id);
        $firstname = $user->firstname;
        $lastname = $user->lastname;

        $friend = new Friendlist();
        $friend->userID = Auth::user()->id;
        $friend->friendID = $id;

        if($friend->userID != (int)$friend->friendID){
            $friendlist = DB::table('friendlist')->select('friendID')->where('userID' , $friend->userID )->get();
            for($n = 0 ; $n < count($friendlist) ; $n++){
                if($friendlist[$n]->friendID == (int)$id){
                    return redirect()->back()->with('fails' , $firstname. ' '.$lastname.' is already in friend list');
                }
            }
            $friend->save();
            return redirect()->back()->with('added' , 'You have Successfully added ' . $firstname . ' ' . $lastname . ' as your friend ');
        }
        else{
            return redirect()->back()->with('fails' , 'Invalid');
        }

    }

    public function showfriends()
    {
        $friends = DB::table('friendlist')
        ->select('users.id' ,'users.firstname','users.lastname', 'users.age', 'users.gender')
        ->rightJoin('users', 'friendlist.friendID', '=', 'users.id')
        ->where('userID', '=', Auth::user()->id)
        ->get();

        return view('Friend.friendlist' , ['friends' => $friends]);
    }

    public function unfriend($id)
    {
        DB::table('Friendlist')->where('friendID' , $id)->delete();

        return redirect()->back()->with('removed' , "Removed!");
    }

}


