<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function(){
	return view('hello');
});

//Route::get('/Tlogin', 'TAuthControl@Tlogin');

Route::get('/Tlogin', function() {
	return view('hello');
});

Route::get('/follower', function () {
	return view('follower');
});

Route::get('/list', function () {
	return view('list');
});

Route::get('/register', function() {
	return view('register');
});

Route::get('/test', function(){
	return view('test');
});

Route::get('/letmein', function() {
	return view('login');
});

/*Route::post('/letmein', function() {
	$cred = Input::only('username', 'password');
	if(Auth::attempt($credentials)) {
		return Redirect::intended('/hello');
	}
	return Redirrect::to('home');
});*/

//Route::post('/register', 'RegisterController@store');
//Route::auth();


Route::auth();

Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
