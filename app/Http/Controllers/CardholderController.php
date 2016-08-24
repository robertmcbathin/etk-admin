<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Mail;

use App\Http\Requests;

class CardholderController extends Controller
{
    protected $table = "users";
    public $email;

    protected $last_inserted_id;

    protected $user;

    public function generatePassword($length = 8)
    {
      $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
      $numChars = strlen($chars);
      $string = '';
      for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
      }
      return $string;
    }

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
    public function getCardholderAdd()
    {
        $cardholders = DB::table('users')
                         ->get();         
        return view('menu.club.cardholders.add',[
            'alert_title' => '',
            'alert_text'  => '',
            'alert_type'    => ''
            ]);
    }
    public function postCardholderAdd(Request $request)
    {
        $this->validate($request,[
        'card_serie' => 'required|min:2',
        'card_number' => 'required|min:6',
        'second_name' => 'required|max:50',
        'first_name' => 'required|max:50',
        'phone'      => 'required'
        ]);
        /*INIT VARIABLES*/
        $card_serie = $request['card_serie'];
        $card_number = $request['card_number'];
        $second_name = $request['second_name'];
        $first_name = $request['first_name'];
        $third_name = $request['third_name'];
        $age = $request['age'];
        $sex = $request['sex'];
        $phone = $request['phone'];
        $email = $request['email'];
        /*--------------*/
        /*CHECK VARIABLES*/
        /*CHECK CARD CREDENTIALS*/
        $card = DB::table('activated_cards')
                ->where('serie', $card_serie)
                ->where('num', $card_number)
                ->first();
        if($card !== NULL)
        {
            return view('menu.club.cardholders.add',[
              'alert_title' => 'Такая карта уже зарегистрирована!',
              'alert_text'  => 'Пользователь не добавлен',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*-----------------------*/
        /*CHECK EMAIL*/
        $request_email = DB::table('users')
                ->where('email', $email)
                ->first();
        if($request_email !== NULL)
        {
            return view('menu.club.cardholders.add',[
              'alert_title' => 'Пользователь с таким E-mail уже зарегистрирован!',
              'alert_text'  => 'Пользователь не добавлен',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*-----------*/
        $request_phone = DB::table('users')
                ->where('phone', $phone)
                ->first();
        if($request_phone !== NULL)
        {
            return view('menu.club.cardholders.add',[
              'alert_title' => 'Пользователь с таким номером телефона уже зарегистрирован!',
              'alert_text'  => 'Пользователь не добавлен',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*-----------*/
        /*---------------*/
        /*GENERATING PASSWORD*/
        $password_to_send = $this->generatePassword();
        $password         = bcrypt($password_to_send);
        /*-------------------*/
        DB::transaction(function() use ($card_serie, $card_number,$first_name,$second_name, $third_name, $email,$phone,$sex,$age,$password){
  
          $preactive_card_id = DB::table('activated_cards')->insertGetId([
              'serie' => $card_serie, 
              'num' => $card_number,
              'is_active' => 1
          ]);
          /*GET CARD ID*/
  
          $this->last_inserted_id = DB::table('users')->insertGetId([
              'username' => '',
              'first_name' => $first_name,
              'second_name' => $second_name,
              'patronymic' => $third_name,
              'email' => $email,
              'phone' => $phone,
              'sex' => $sex,
              'dob' => $age,
              'password' => $password,
              'card_id' => $preactive_card_id,
              'is_active' => 1
          ]);
          /*GET USER ROW*/
          $this->user = DB::table('users')
                        ->where('card_id', $preactive_card_id)
                        ->first();
        });
        $user_id = $this->user->id;
        $email   =$this->user->email;
        if ($email !== null){
          if(Mail::send('emails.email_confirmed',
                      ['user_id' => $user_id,
                       'email' => $email,
                       'password' => $password_to_send],
                       function ($m) use ($email){
                $m->from('activation@etk-club.ru', 'ЕТК-Клуб');
                $m->to($email)->subject('Успешная активация аккаунта в программе "ЕТК-Клуб"');
                })
          )
        return view('menu.club.cardholders.add',[
            'alert_title' => 'Пользователь добавлен',
            'alert_text'  => 'Пользователь успешно добавлен',
            'alert_type'    => 'alert-success'
            ]);
        } else {
          $email = 'passwords@etk-club.ru';
          if(Mail::send('emails.email_confirmed',
                      ['user_id' => $user_id,
                       'email' => $email,
                       'password' => $password_to_send],
                       function ($m) use ($email){
                $m->from('activation@etk-club.ru', 'ЕТК-Клуб');
                $m->to($email)->subject('Успешная активация аккаунта в программе "ЕТК-Клуб"');
                })
          )
        return view('menu.club.cardholders.add',[
            'alert_title' => 'Пользователь добавлен',
            'alert_text'  => 'Пользователь успешно добавлен',
            'alert_type'    => 'alert-success'
            ]);
        }

    }
    public function getDeleteCardholder($cardholder_id)
    {
      DB::transaction(function () use ($cardholder_id){
        $cardholder = DB::table('users')->where('id',$cardholder_id)->first();
        DB::table('users')->where('id',$cardholder_id)->delete();
        DB::table('activated_cards')->where('id',$cardholder->card_id)->update(['is_active' => 0]);
      });
      return redirect()->route('club.cardholders.list');
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
