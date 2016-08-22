<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class UserController extends Controller
{
	public function showCallbacks()
	{
    $callbacks = DB::table('callbacks')
                   ->leftJoin('users', 'callbacks.user_id', '=', 'users.id')
                   ->select('callbacks.id',
                   	        'callbacks.message',
                   	        'callbacks.user_id',
                   	        'users.first_name',
                   	        'users.second_name',
                   	        'users.phone as phone',
                   	        'callbacks.phone as phone',
                   	        'callbacks.created_at',
                   	        'callbacks.processing_by',
                   	        'callbacks.closed_by'
                   	        )
                   ->orderBy('created_at', 'desc')
                   ->get();
    return view('menu.shop.callbacks',[
    	'callbacks' => $callbacks
    	]);
    }
    public function getProcessCallback($id,$user_id)
    {
    	if (DB::table('callbacks')
    		  ->where('id',$id)
    		  ->update([
    		  	'processing_by' => $user_id
    		  ]))
    		return redirect()->back();
    }
    public function getDoneCallback($id,$user_id)
    {
    	if (DB::table('callbacks')
    		  ->where('id',$id)
    		  ->update([
    		  	'closed_by' => $user_id
    		  ]))
    		return redirect()->back();
    }
}
