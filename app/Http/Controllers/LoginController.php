<?php

namespace App\Http\Controllers;

use App\User;
use App\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;


class LoginController extends Controller
{

    public function welcome(){
        return view('login');
    }


    public function guest(){
        return view('home');
    }


    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if(!Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect()->back();
        }

        return redirect()->route('login');

    }

    public function logout(){
        Auth::logout();

        return redirect()->route('welcome');
    }

    public function register(Request $request)
    {

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $this->validate( $request, [
                'firstname' =>'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:6',
                're-password' => 'required|same:password',
                'gender' => 'required|in:Male,Female',
            ]);

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        User::create($input);

        Mail::to($request->input('email'))->send(new SendEmail($firstname , $lastname));
        return view('Confirmation.verification');

    }

    public function join(Request $request){
        $guest = new Guest();

        $guest->name = 'Guest' . rand(0 , 1000);
        $guest->age = $request->age;
        $guest->gender = $request->gender;

        $guest->save();

        return view('home');
    }

}
