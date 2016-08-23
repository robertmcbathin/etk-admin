<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DB;
use Auth;
use App\Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function showOrders()
    {
    	$orders = DB::table('orders')
    					 ->leftJoin('users','orders.user_id','=','users.id')
    					 ->leftJoin('employees','orders.processing_by','=','employees.id')
    					 ->leftJoin('settings_order_status_types','orders.status', '=','settings_order_status_types.id' )
    					 ->leftJoin('settings_delivery_types','orders.delivery_type', '=','settings_delivery_types.id' )
    					 ->leftJoin('settings_delivery_points','orders.delivery_point', '=', 'settings_delivery_points.id')
    					 ->leftJoin('settings_payment_types','orders.payment_type', '=', 'settings_payment_types.id')
    					 ->where('orders.user_id', '!=', null)
    					 ->select(
    					 'orders.id',
    					 'orders.user_id',
    					 'users.first_name as name',
    					 'users.second_name as second_name',
    					 'users.phone',
    					 'settings_order_status_types.name as status',
    					 'settings_delivery_types.name as delivery_type',
    					 'employees.username as processing_by',
    					 'settings_delivery_points.name as delivery_point',
    					 'settings_payment_types.name as payment_type',
    					 'orders.is_closed',
    					 'orders.created_at',
    					 'orders.updated_at',
    					 'orders.cart'
    					 )
    	                 ->get();
    	   foreach ($orders as $order){
    	   	$order->cart = unserialize($order->cart);
    	   }     
    	 //  dd($orders);         
    	return view('menu.shop.orders',[
        'orders' => $orders
        ]);
    }
    public function postDeleteOrder($id)
    {
    	DB::table('orders')
    	  ->where('id',$id)
    	  ->delete();
    	return redirect()->back();
    }
    public function getChangeOrderStatus($order_id, $status_id)
    {
    	$user_id = Auth::user()->id;
    	if ($status_id == 2){
    		DB::table('orders')
    		  ->where('id',$order_id)
    		  ->update(['processing_by' => $user_id]);
    	} elseif ($status_id == 7){
    		DB::table('orders')
    		  ->where('id',$order_id)
    		  ->update(['is_closed' => 1]);
    	};
    	DB::table('orders')
    	  ->where('id',$order_id)
    	  ->update([
    	  	'status' => $status_id
    	  	]);
    	return redirect()->back();
    }
}
