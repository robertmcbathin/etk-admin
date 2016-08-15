<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;

class BannerController extends Controller
{
    public function showBanners()
    {
    	$banners = DB::table('banners')
    	              ->get();
    	return view('menu.shop.banners',[
    		'banners' => $banners
    		]);
    }
    public function getAddBanner()
    {
    	return view('menu.shop.add_banner',[
    		'alert_title' => '',
            'alert_text'  => '',
            'alert_type'    => ''
    		]);
    }
    public function postAddBanner(Request $request)
    {
    	/*VALIDATING INPUT*/
      $this->validate($request,[
        'title' => 'required|min:1|max:45',
        'description' => 'required|min:1|max:255',
        'show_in' => 'required|numeric',
        'path_to_img' => 'url',
        'order' => 'required|numeric'
        ]);
      /*DEFAULT VALUES FOR VARIABLES*/
      $order               = 1;
      $path_to_img = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=320%C3%97150&w=800&h=300';
      /*INIT VARIABLES*/
   /*   $published              = $request['published'];*/
      $title            = $request['title'];
      $description      = $request['description'];
      $show_in          = $request['show_in'];
      $path_to_img      = $request['path_to_img'];
      $order            = $request['order'];
      $created_by       = $request['created_by'];
      

      $image = $request->file('image');
      $imagename = 'banners/' . $this->str2url($request['title']) . '.jpg';
      if ($image){
        Storage::disk('public')->put($imagename, File::get($image));
        $path_to_img = 'http://etk-admin.ru/src/images/' . $imagename;
      }

      if (DB::table('banners')->insert([
        'title'                   => $title,
        'description'          => $description,
        'show_in'       => $show_in,
        'path_to_img'            => $path_to_img,
        'order'               => $order,
        'created_by'           => $created_by
        ]))   
      {return view('menu.shop.add_banner',[
        'alert_title' => 'Баннер добавлен',
        'alert_text'  => 'Добавлен новый баннер',
        'alert_type'    => 'alert-success'
        ]);
      }
    }
    public function postDeleteBanner($id)
    {
        DB::table('banners')->where('id',$id)->delete();
        return redirect()->back();
    }
     public function getEditBanner($id)
    {
      $banner = DB::table('banners')
              ->where('id', $id)
              ->first();
      return view('menu.shop.edit_banner',[
        'banner' => $banner,
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
