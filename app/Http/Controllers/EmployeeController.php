<?php

namespace App\Http\Controllers;

use App\Employee;
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
}
