<?php

namespace App\Http\Controllers;

use App\Employee;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class EmployeeController extends Controller
{
	public function getDashboard()
	{
		$user = Auth::user();
		return view('dashboard',
			['user' => $user]);
	}
	public function getUserList()
	{
		$users = DB::table('employees')
		       ->get();
		return view('menu.settings.users',
			['users' => $users]);
	}
}
