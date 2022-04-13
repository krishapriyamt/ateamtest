<?php

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::middleware(['auth'])->group( function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/user', 'UserController');
    Route::post('/user/request_send', 'UserController@friendRequest');
    Route::post('/user/accept_request', 'UserController@acceptFriendRequest');
    Route::get('/getfriendrequest', 'UserController@getfriendrequest');
    Route::get('/sendrequestlist', 'UserController@sendrequestlist');
    Route::get('/myfriends', 'UserController@myFriends');
    Route::get('/profile_edit', 'UserController@profileEdit');
    Route::post('/user/update', 'UserController@update');
});


