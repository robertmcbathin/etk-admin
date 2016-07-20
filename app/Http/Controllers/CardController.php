<?php

namespace App\Http\Controllers;

use App\Card;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class CardController extends Controller
{
    public function showCardDashboard()
    {
    	$awaiting_cards = DB::table('cards')
    	                  ->where('activation_token', '!=' , null)
    	                  ->get();
    	$awaiting_cards_count = DB::table('cards')
    	                  ->where('activation_token', '!=' , null)
    	                  ->count();
    	$active_cards = DB::table('activated_cards')
    	                  ->where('is_active', '!=' , null)
    	                  ->get();
    	$active_cards_count = DB::table('activated_cards')
    	                  ->where('is_active', '!=' , null)
    	                  ->count();

    	return view('menu.club.cards',[
    		'awaiting_cards' => $awaiting_cards,
    		'awaiting_cards_count' => $awaiting_cards_count,
    		'active_cards' => $active_cards,
    		'active_cards_count' => $active_cards_count
    		]);
    }
}
