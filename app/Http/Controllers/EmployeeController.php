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
		return view('dashboard');
	}
}
