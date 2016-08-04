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
    public function getDeleteCardholder($cardholder_id)
    {
      DB::transaction(function () use ($cardholder_id){
        $cardholder = DB::table('users')->where('id',$cardholder_id)->first();
        DB::table('users')->where('id',$cardholder_id)->delete();
        DB::table('activated_cards')->where('id',$cardholder->card_id)->update(['is_active' => 0]);
        return redirect()->back();
      });
    }
    public function getUnlockCardholder($cardholder_id)
    {
      DB::table('users')
                ->where('id', $cardholder_id)
                ->update(['is_active' => 1]);
      return redirect()->back();
    }
    public function getLockCardholder($cardholder_id)
    {
      DB::table('users')
                ->where('id', $cardholder_id)
                ->update(['is_active' => 0]);
      return redirect()->back();
    }
}
