<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class ProductController extends Controller
{
	public function objectToArray($data)
    {
       $array = (array)$data;
       foreach($array as $key => &$field){
           if(is_object($field))$field = $this->objectToarray($field);
    }
    return $array;
   }

    public function getAddCategory()
    {
    	return view('menu.shop.add_category',[
    		'alert_title' => '',
            'alert_text'  => '',
            'alert_type'    => ''
    		]);
    }
    public function postAddCategory(Request $request)
    {
    	/*VALIDATING INPUT*/
      $this->validate($request,[
        'category_name' => 'required'
        ]);
      /*INIT VARIABLES*/
      $category_name  = $request['category_name'];

      /*CHECK CARD CREDENTIALS*/
      $category = DB::table('categories')->where('name',$category_name)
                                  ->first();
        if($category !== NULL)
        {
            return view('menu.shop.add_category',[
              'alert_title' => 'Такая категория уже существует!',
              'alert_text'  => 'Запись не добавлена',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*----------------------*/

      if (DB::table('categories')->insert([
        'name'            => $category_name
        ]))
      {return view('menu.shop.add_category',[
        'alert_title' => 'Запись добавлена',
        'alert_text'  => 'Добавлена новая категория',
        'alert_type'    => 'alert-success'
        ]);
      }
    }

    public function showCategories()
    {
      $сategories = DB::table('categories')
                          ->orderBy('id', 'asc')
                          ->get();
      $subсategories = DB::table('subcategories')
      					  ->join('categories','subcategories.category_id', '=','categories.id')
      					  ->select('subcategories.id', 'subcategories.name','categories.name as category_name','subcategories.updated_at','subcategories.created_at')
                          ->get();

      return view('menu.shop.categories',[
        'categories' => $сategories,
        'subcategories' => $subсategories
        ]);
    }
    public function postDeleteCategory($id)
    {
    	DB::table('categories')->where('id',$id)->delete();
    	return redirect()->back();
    }
  /*---------------SUBCATEGORIES----------------*/
  	public function getAddSubCategory()
    {
    	$categories = DB::table('categories')
    					->select('name')
    					->get();
    	return view('menu.shop.add_subcategory',[
    		'alert_title' => '',
            'alert_text'  => '',
            'alert_type'    => '',
            'categories' => $categories
    		]);
    }

    public function postAddSubCategory(Request $request)
    {
    	/*VALIDATING INPUT*/
      $this->validate($request,[
        'subcategory_name' => 'required',
        'category_name' => 'required'
        ]);
      /*INIT VARIABLES*/
      $subcategory_name  = $request['subcategory_name'];
      $category_name       = $this->objectToArray($request['category_name']);

      $category_id = DB::table('categories')
      					->select('id')
      					->where('name',$category_name)
      					->first();

      $subcategory = DB::table('subcategories')->where('name',$subcategory_name)
                                  ->first();
        if($subcategory !== NULL)
        {
            return view('menu.shop.add_subcategory',[
              'alert_title' => 'Такая подкатегория уже существует!',
              'alert_text'  => 'Запись не добавлена',
              'alert_type'    => 'alert-error',
              'categories' => ''
            ]);
        }
        /*----------------------*/

      if (DB::table('subcategories')->insert([
        'name'            => $subcategory_name,
        'category_id' => $category_id->id
        ]))
      {return view('menu.shop.add_subcategory',[
        'alert_title' => 'Запись добавлена',
        'alert_text'  => 'Добавлена новая подкатегория',
        'alert_type'    => 'alert-success',
        'categories' => ''
        ]);
      }
    }


    public function postDeleteSubCategory($id)
    {
    	DB::table('subcategories')->where('id',$id)->delete();
    	return redirect()->back();
    }

     /*---------------PRODUCTS----------------*/

    public function showProducts()
    {


      $сategories    = DB::table('categories')
                          ->orderBy('name', 'asc')
                          ->get();
      $subсategories = DB::table('subcategories')
                          ->orderBy('name', 'asc')
                          ->get();
      $products      = DB::table('products')
      				      ->orderBy('name', 'asc')
                          ->get();

      return view('menu.shop.products',[
        'categories' => $сategories,
        'subcategories' => $subсategories,
        'products' => $products
        ]);
    }

  	public function getAddProduct()
    {
    	$subcategories = DB::table('subcategories')
    					->select('name')
    					->get();
    	return view('menu.shop.add_product',[
    		'alert_title' => '',
            'alert_text'  => '',
            'alert_type'    => '',
            'subcategories' => $subcategories
    		]);
    }

    public function postAddProduct(Request $request)
    {
    	/*VALIDATING INPUT*/
      $this->validate($request,[
        'subcategory_name' => 'required',
        'category_name' => 'required'
        ]);
      /*INIT VARIABLES*/
      $subcategory_name  = $request['subcategory_name'];
      $category_name       = $this->objectToArray($request['category_name']);

      $category_id = DB::table('categories')
      					->select('id')
      					->where('name',$category_name)
      					->first();

      $subcategory = DB::table('subcategories')->where('name',$subcategory_name)
                                  ->first();
        if($subcategory !== NULL)
        {
            return view('menu.shop.add_subcategory',[
              'alert_title' => 'Такая подкатегория уже существует!',
              'alert_text'  => 'Запись не добавлена',
              'alert_type'    => 'alert-error',
              'categories' => ''
            ]);
        }
        /*----------------------*/

      if (DB::table('subcategories')->insert([
        'name'            => $subcategory_name,
        'category_id' => $category_id->id
        ]))
      {return view('menu.shop.add_subcategory',[
        'alert_title' => 'Запись добавлена',
        'alert_text'  => 'Добавлена новая подкатегория',
        'alert_type'    => 'alert-success',
        'categories' => ''
        ]);
      }
    }


    public function postDeleteProduct($id)
    {
    	DB::table('subcategories')->where('id',$id)->delete();
    	return redirect()->back();
    }

    public function postUnlockProduct($id)
    {
      DB::table('products')
                ->where('id', $id)
                ->update(['published' => 1]);
      return redirect()->back();
    }
    public function postLockProduct($id)
    {
      DB::table('products')
                ->where('id', $id)
                ->update(['published' => 0]);
      return redirect()->back();
    }
}
