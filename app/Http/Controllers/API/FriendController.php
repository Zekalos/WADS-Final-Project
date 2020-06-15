<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Friendlist;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class FriendController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    // search friend
    public function show()
    {
        $friends = DB::table('friendlist')
        ->select('users.id' ,'users.firstname','users.lastname', 'users.age', 'users.gender')
        ->rightJoin('users', 'friendlist.friendID', '=', 'users.id')
        ->where('userID', '=', Auth::id())
        ->get();

        return $this->sendResponse($friends->toArray(), 'My Friendlist');
    }


    public function add($id)
    {
        $user = User::Find($id);
        $firstname = $user->firstname;
        $lastname = $user->lastname;

        $friend = new Friendlist();
        $friend->userID = Auth::id();
        $friend->friendID = $id;

        if($friend->userID != (int)$friend->friendID){
            $friendlist = DB::table('friendlist')->select('friendID')->where('userID' , $friend->userID )->get();
            for($n = 0 ; $n < count($friendlist) ; $n++){
                if($friendlist[$n]->friendID == (int)$id){
                    return $this->sendError('Cannot Add this User');
                }
            }
            $friend->save();
            return $this->sendResponse($friend , 'Friend Added');
        }
        else{
            return $this->sendError('Error');
        }

    }


    public function unfriend($id)
    {
        $friend =  DB::table('Friendlist')->where('friendID' , $id)->delete();

        return $this->sendResponse($friend , 'Friend Deleted');
    }



}
