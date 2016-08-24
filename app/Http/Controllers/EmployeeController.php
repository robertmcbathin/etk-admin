<?php

namespace App\Http\Controllers;

use App\Employee;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class EmployeeController extends Controller
{
	protected $redirectTo = 'dashboard';

	public function getDashboard()
	{
		$card_count = DB::table('cards')
		                ->count();
		$awaiting_cards_count = DB::table('cards')
    	                           ->where('activation_token', '!=' , null)
    	                           ->count();
    	$active_cards_count = DB::table('activated_cards')
    	                           ->where('is_active', 1)
    	                           ->count();
        $deactive_cards_count = DB::table('activated_cards')
                        ->where('is_active', 2)
                        ->count();
		$user = Auth::user();
		return view('dashboard',
			['user' => $user,
			 'card_count' => $card_count,
			 'awaiting_cards_count' => $awaiting_cards_count,
			 'active_cards_count' => $active_cards_count,
             'deactive_cards_count' => $deactive_cards_count
             ]);
	}
	public function getUserList()
	{
		$users = DB::table('employees')
		       ->get();
		return view('menu.settings.users',
			['users' => $users]);
	}
	 public function postLogIn(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required|min:4'
            ]);
        $username = $request['username'];
        $password = $request['password'];
        if (Auth::attempt(['username' => $username, 'password' => $password])){
            return redirect()->route($this->redirectTo);
        }
        return redirect()->back();
      /*  if (Hash::check($password, $hashed_password)){
            $user = new Employee();
            $user->username = $username;
            Auth::login($user);
            return redirect()->route($this->redirectTo);
        }
        return redirect()->back();*/
    }
    public function getLogIn()
    {
        return view('auth.login');
    }
    public function getLogOut()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    public function getRegister()
    {
        return view('auth.register');
    }
}
