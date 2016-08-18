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
    public function postDeleteManufacturer($id)
    {
        DB::table('manufacturers')->where('id',$id)->delete();
        return redirect()->back();
    }
     public function getEditManufacturer($id)
    {
      $manufacturer = DB::table('manufacturers')
              ->where('id', $id)
              ->first();
      return view('menu.shop.edit_manufacturer',[
        'manufacturer' => $manufacturer,
        'alert_title' => '',
        'alert_type'    => ''
        ]);
    }
    public function postEditManufacturer(Request $request)
    {
      /*VALIDATING INPUT*/
      $this->validate($request,[
        'name' => 'required'
        ]);
      /*INIT VARIABLES*/
      $manufacturer_name  = $request['name'];
      $manufacturer_id  = $request['id'];
      $manufacturer_address = $request['address'];

      /*CHECK CARD CREDENTIALS*/
      $manufacturer = DB::table('manufacturers')
                    ->where('name',$manufacturer_name)
                    ->first();
        if($manufacturer !== NULL)
        {
            return view('menu.shop.edit_manufacturer',[
              'manufacturer'   => $manufacturer,
              'alert_title' => 'Зачем сохранять то же название?!',
              'alert_text'  => 'Название производителя не изменено',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*----------------------*/

      if (DB::table('manufacturers')
                   ->where('id',$manufacturer_id)
                   ->update(['name' => $manufacturer_name, 
                             'address' => $manufacturer_address
        ]))
      {$manufacturer = DB::table('manufacturers')
                  ->where('id',$manufacturer_id)
                  ->first();
        return view('menu.shop.edit_manufacturer',[
        'manufacturer'   => $manufacturer,
        'alert_title' => 'Запись изменена',
        'alert_text'  => 'Название производителя изменено',
        'alert_type'    => 'alert-success'
        ]);
      }
    }
}
