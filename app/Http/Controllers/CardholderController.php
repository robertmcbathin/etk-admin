<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

use App\Http\Requests;

class CardholderController extends Controller
{
    protected $table = "users";

    public function showCardholderList()
    {
    	$cardholders = DB::table('users')
    	                 ->get();
    	$cardholders_count = DB::table('users')
    	                 ->count();             
    	return view('menu.club.cardholders.list',[
    		'cardholders' => $cardholders,
    		'cardholders_count' => $cardholders_count
    		]);
    }
}
