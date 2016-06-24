<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;

use Auth;

use DB;
class FListController extends Controller
{
    public function retrieve(Request $request)
    {
    	$username = $request->username;

    	return Redirect::to('list')->with('username', $username);
    }

    public function store(Request $request)
    {
    	$user = Auth::user();

    	$username = $request->username;

    	$userid = $user->id;
    	$tcolor = $request->tcolor;
    	$bcolor = $request->bcolor;

    	$check = DB::select('select * from ListSettings where userid = ?', [$userid]);

    	if (is_null($check)) {

    		DB::insert('insert into ListSettings (userid, tcolor, bcolor) values (?, ?, ?)', [$userid, $tcolor, $bcolor]);

    	}else{
    		DB::delete('delete from ListSettings where userid=?', [$userid]);

    		DB::insert('insert into ListSettings (userid, tcolor, bcolor) values (?, ?, ?)', [$userid, $tcolor, $bcolor]);

    	}

    	//DB::insert('insert into ListSettings (userid, tcolor, bcolor) values (?, ?, ?)', [$userid, $tcolor, $bcolor]);

    	return Redirect::to('list')->with('username', $username);
    }
}
