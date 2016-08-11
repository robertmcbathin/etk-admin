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
    	$awaiting_cards = DB::table('activated_cards')
                          ->join('users', 'activated_cards.id', '=' , 'users.card_id')
    	                  ->select('activated_cards.id', 'activated_cards.serie', 'activated_cards.num',
                                   'activated_cards.is_active',
                                   'users.first_name', 'users.second_name', 'users.email', 'users.phone','users.created_at')
                          ->where('activated_cards.is_active',null)
                          ->orderBy('users.created_at', 'desc')
    	                  ->get();
    	$awaiting_cards_count = DB::table('cards')
    	                  ->where('activation_token', '!=' , null)
    	                  ->count();
    	$active_cards = DB::table('activated_cards')
                          ->join('users', 'activated_cards.id', '=' , 'users.card_id')
                          ->select('activated_cards.id', 'activated_cards.serie', 'activated_cards.num',
                                   'activated_cards.is_active',
                                   'users.first_name', 'users.second_name', 'users.email', 'users.phone','users.updated_at')
                          ->where('activated_cards.is_active', 1)
                          ->orderBy('users.updated_at', 'desc')
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
    public function showCardActivationQueue()
    {
      $awaiting_cards = DB::table('activated_cards')
                          ->join('users', 'activated_cards.id', '=' , 'users.card_id')
                        ->select('activated_cards.id', 'activated_cards.serie', 'activated_cards.num',
                                   'activated_cards.is_active',
                                   'users.first_name', 'users.second_name', 'users.email', 'users.phone','users.created_at')
                          ->where('activated_cards.is_active',null)
                          ->orderBy('users.created_at', 'desc')
                        ->get();
      $awaiting_cards_count = DB::table('cards')
                        ->where('activation_token', '!=' , null)
                        ->count();
      return view('menu.club.cards.queue',[
        'awaiting_cards' => $awaiting_cards,
        'awaiting_cards_count' => $awaiting_cards_count
        ]);
    }

    public function showActivatedCards()
    {
      $active_cards = DB::table('activated_cards')
                          ->join('users', 'activated_cards.id', '=' , 'users.card_id')
                          ->select('activated_cards.id', 'activated_cards.serie', 'activated_cards.num',
                                   'activated_cards.is_active',
                                   'users.first_name', 'users.second_name', 'users.email', 'users.phone','users.updated_at')
                          ->where('activated_cards.is_active', 1)
                          ->orderBy('users.updated_at', 'desc')
                          ->get();
      $active_cards_count = DB::table('activated_cards')
                        ->where('is_active', '!=' , null)
                        ->count();

      return view('menu.club.cards.activated',[
        'active_cards' => $active_cards,
        'active_cards_count' => $active_cards_count
        ]);
    }

    public function getCardAdd()
    {
      return view('menu.club.cards.add',[
        'alert_title' => '',
        'alert_text'  => '',
        'alert_type'    => ''
        ]);
    }
    public function postCardAdd(Request $request)
    {
      /*VALIDATING INPUT*/
      $this->validate($request,[
        'card_serie' => 'required|min:2',
        'card_number' => 'required|min:6'
        ]);
      /*INIT VARIABLES*/
      $card_serie  = $request['card_serie'];
      $card_number = $request['card_number'];

      /*CHECK CARD CREDENTIALS*/
      $card = DB::table('cards')->where('serie',$card_serie)
                                  ->where('num',$card_number)
                                  ->first();
        if($card !== NULL)
        {
            return view('menu.club.cards.add',[
              'alert_title' => 'Такая карта уже зарегистрирована!',
              'alert_text'  => 'Запись не добавлена',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*----------------------*/

      if (DB::table('cards')->insert([
        'serie'            => $card_serie,
        'num'              => $card_number,
        'is_activated'     => 0,
        'activation_token' => null
        ]))
      {return view('menu.club.cards.add',[
        'alert_title' => 'Запись добавлена',
        'alert_text'  => 'Добавлена новая карта',
        'alert_type'    => 'alert-success'
        ]);
      }
    }

    /* AJAX */
    public function ajaxCheckCardCredentials(Request $request)
    {
      $serie = $request['serie'];
      $num   = $request['num'];

      $card = DB::table('cards')
                ->where('serie', $serie)
                ->where('num', $num)
                ->first();
      if ($card == NULL)
        return response()->json(['message' => 'error'],200);
      if ($card !== NULL)
        return response()->json(['message' => 'success'],200);
   //  else
   //    return response()->json(['message' => 'fail'],200)
    }
    /*------*/
    public function update()
    {
      $cards = DB::table('cards')
                  ->where('serie', '40');
      foreach ($cards as $card)
      {
        $oldnum = '' . $card['num'];
        $new_num = (int)ltrim($oldnum, '140');
        DB::table('cards')
          ->where('num', $card['num'])
          ->update(['num' => $new_num]);
      }
      return 'done';
    }
}
