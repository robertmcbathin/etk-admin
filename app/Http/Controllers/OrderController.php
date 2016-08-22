<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function showOrders()
    {
    	$orders = DB::table('orders')->get();
    	return view('menu.shop.orders',[
        'orders' => $orders
        ]);
    }
}
