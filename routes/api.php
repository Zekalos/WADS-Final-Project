<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'API\RegisterController@register');

Route::middleware('auth:api')->group(function(){
    Route::resource('room' , 'API\RoomController');
});

Route::get('/people' , 'API\FriendController@show');
Route::post('/people/add/{id}', 'API\FriendController@add');
Route::delete('/people/delete/{id}', 'API\FriendController@unfriend');


