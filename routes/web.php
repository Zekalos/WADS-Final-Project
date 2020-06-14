<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/' , 'LoginController@welcome')->middleware('guest')->name('welcome');

Route::get('/home', 'RoomController@index')->middleware('auth')->name('home');

Route::post('/register' , 'LoginController@register')->middleware('guest')->name('register');
Route::post('/home' , 'LoginController@login')->middleware('guest')->name('login');
Route::get('/logout', 'LoginController@logout')->middleware('auth')->name('logout');

Route::post('/join' , 'LoginController@join')->middleware('guest')->name('join');

Route::resource('Room', 'RoomController');
Route::post('/create' , 'RoomController@create')->name('create');
Route::post('/room/{id}' , 'HomeController@join')->middleware('auth')->name('joined');
Route::get('/room/findroom' , 'HomeController@searchroom')->middleware('auth')->name('findroom');

Route::get('/people/friendlist' , 'FriendController@showfriends')->middleware('auth');
Route::get('/people/find' , 'FriendController@search')->middleware('auth')->name('find');
Route::post('/people/find/{id}' , 'FriendController@add')->middleware('auth')->name('add');
Route::post('people/find/delete/{id}' , 'FriendController@unfriend')->middleware('auth')->name('unfriend');

Route::get('/private', 'PrivateController@showcontacts')->middleware('auth');
Route::get('/private/{id}', 'PrivateController@message');
Route::post('/private/{id}/send', 'PrivateController@sendmessage');

Route::get('/public', 'PublicController@showrooms')->middleware('auth');
Route::get('/public/{id}', 'PublicController@getname')->name('partyname');
Route::get('/public/{id}/members', 'PublicController@memberlist')->name('memberlist');
Route::get('/public/{id}/chat', 'PublicController@message');
Route::post('/public/{id}/chat/send', 'PublicController@sendmessage');
Route::post('/public/{id}/delete', 'PublicController@leaveRoom')->middleware('auth')->name('leaveroom');

