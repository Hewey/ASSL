<?php

namespace App\Http\Controllers;

use App\User;

use Redirect;

use Hash;

use Illuminate\Http\Request;

use App\Http\Requests;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
    	//return $request->all();

    	$user = new User;
    	$user->username = $request->username;
    	$user->password = Hash::make($request->password);
    	$user->save();
    	return Redirect::to('test')->with('username', $user->username);
    }
}
