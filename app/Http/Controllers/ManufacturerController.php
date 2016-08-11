<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;

class ManufacturerController extends Controller
{
    public function showManufacturers()
    {
      $manufacturers = DB::table('manufacturers')
                          ->orderBy('id', 'asc')
                          ->get();

      return view('menu.shop.manufacturers',[
        'manufacturers' => $manufacturers,
        ]);
    }
    public function getAddManufacturer()
    {
    	return view('menu.shop.add_manufacturer',[
    		'alert_title' => '',
            'alert_text'  => '',
            'alert_type'    => ''
    		]);
    }
    public function postAddManufacturer(Request $request)
    {
    	/*VALIDATING INPUT*/
        $this->validate($request,[
          'name' => 'required',
          'address' => 'required'
        ]);
        /*INIT VARIABLES*/
        $name = $request['name'];
        $address = $request['address'];

    	DB::table('manufacturers')
    	  ->insert([
    	  	'name' => $name,
    	  	'address' => $address
    	]);
    	return view('menu.shop.add_manufacturer',[
    		'alert_title' => 'Производитель создан',
            'alert_text'  => 'Все ништяк',
            'alert_type'    => 'success'
    		]);
    }
}
