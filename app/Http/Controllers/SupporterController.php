<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use DB;

use Redirect;

class SupporterController extends Controller
{
    public function add(Request $request)
    {
    	//return $request->all();
    	$user = Auth::user();

    	$userid = $user->id;
    	$name = $request->name;
    	$amount = $request->amount;

    	DB::insert('insert into supporters (userid, name, amount) values (?, ?, ?)', [$userid, $name, $amount]);

    	return Redirect::to('supporters');
    }

    public function destroy(Request $request)
    {
    	//return $request->all();

    	$id = $request->id;
    	$userid = $request->userid;

    	DB::delete('delete from supporters where id=? AND userid=?', [$id, $userid]);

		return Redirect::to('supporters');    	
    }

    public function update(Request $request)
    {
    	//return $request->all();

    	$name = $request->name;
    	$amount = $request->amount;
    	$id = $request->id;
    	$userid = $request->userid;

    	DB::update('update supporters set name=?, amount=? where id=? and userid=?', [$name, $amount, $id, $userid]);

		return Redirect::to('supporters');    	
    }
}
