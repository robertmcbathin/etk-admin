<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function rus2translit($string) 
    {  
      $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
    }
  public function str2url($str) 
  {
    // переводим в транслит
    $str = $this->rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
  }
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

    public function getEditCategory($category_id)
    {
      $category = DB::table('categories')
              ->where('id', $category_id)
              ->first();
      return view('menu.shop.edit_category',[
        'category' => $category,
        'alert_title' => '',
        'alert_type'    => ''
        ]);
    }
    public function postEditCategory(Request $request)
    {
      /*VALIDATING INPUT*/
      $this->validate($request,[
        'category_name' => 'required'
        ]);
      /*INIT VARIABLES*/
      $category_name  = $request['category_name'];
      $category_id  = $request['category_id'];

      /*CHECK CARD CREDENTIALS*/
      $category = DB::table('categories')->where('name',$category_name)
                                  ->first();
        if($category !== NULL)
        {
            return view('menu.shop.edit_category',[
              'category'   => $category,
              'alert_title' => 'Зачем сохранять то же название?!',
              'alert_text'  => 'Название категории не изменено',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*----------------------*/

      if (DB::table('categories')
                   ->where('id',$category_id)
                   ->update(['name' => $category_name
        ]))
      {return view('menu.shop.edit_category',[
        'category'   => $category,
        'alert_title' => 'Запись изменена',
        'alert_text'  => 'Название категории изменено',
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
     public function getEditSubCategory($subcategory_id)
    {
      $categories = DB::table('categories')
                          ->get();
      $subcategory = DB::table('subcategories')
              ->where('id', $subcategory_id)
              ->first();
      return view('menu.shop.edit_subcategory',[
        'categories' => $categories,
        'subcategory' => $subcategory,
        'alert_title' => '',
        'alert_type'    => ''
        ]);
    }
    public function postEditSubCategory(Request $request)
    {
      /*VALIDATING INPUT*/
      $this->validate($request,[
        'subcategory_name' => 'required',
        'category_name' => 'required'
        ]);
      /*INIT VARIABLES*/
      $subcategory_name  = $request['subcategory_name'];
      $category_name       = $this->objectToArray($request['category_name']);
      $subcategory_id  = $request['subcategory_id'];

      $category = DB::table('categories')
                         ->where('name', $category_name)
                         ->first();
        /*----------------------*/

      if (DB::table('subcategories')
                   ->where('id',$subcategory_id)
                   ->update(['name' => $subcategory_name,
                    'category_id' => $category->id
        ]))
      {return view('menu.shop.edit_category',[
        'category'   => $category,
        'alert_title' => 'Запись изменена',
        'alert_text'  => 'Название подкатегории изменено',
        'alert_type'    => 'alert-success'
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

  	public function getAddProduct($category_id)
    {
    	$category = DB::table('categories')
              ->where('id', $category_id)
    					->first();
      $subcategories = DB::table('subcategories')
              ->where('category_id', $category_id)
              ->get();
    	return view('menu.shop.add_product',[
    		'alert_title' => '',
            'alert_text'  => '',
            'alert_type'    => '',
            'category' => $category,
            'subcategories' => $subcategories

    		]);
    }

    public function getEditProduct($category_id, $subcategory_id, $id)
    { 
      $category = DB::table('categories')
              ->where('id', $category_id)
              ->first();
      $subcategories = DB::table('subcategories')
              ->where('category_id', $category_id)
              ->get();
      $product = DB::table('products')
                   ->where('id', $id)
                   ->first();

      return view('menu.shop.edit_product',[
            'product'    => $product,
            'subcategories' => $subcategories,
            'category' => $category
        ]);
    }

    public function postEditProduct(Request $request)
    { 
      $this->validate($request,[
        'name' => 'required|min:1|max:255',
        'short_description' => 'required|min:1|max:255',
        'subcategory_id' => 'required',
        'price' => 'required|numeric',
        'price_by_card' => 'required|numeric',
        'price_by_action' => 'numeric',
        'price_by_purchase' => 'numeric',
        'price_by_purchase_card' => 'numeric',
        'path_to_img' => 'url',
        'in_stock' => 'required'
        ]);
      /*DEFAULT VALUES FOR VARIABLES*/
      $id                     =$request['product_id'];
      $published              = 1;
      $price_by_action        = null;
      $price_by_purchase      = null;
      $price_by_purchase_card = null;

      $path_to_img = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=320%C3%97150&w=320&h=150';
      /*INIT VARIABLES*/
   /*   $published              = $request['published'];*/
      $name                   = $request['name'];
      $short_description      = $request['short_description'];
      $long_description       = $request['long_description'];

      $subcategory_id         = $request['subcategory_id'];

      $price                  = $request['price'];
      $price_by_card          = $request['price_by_card'];
      $price_by_action        = $request['price_by_action'];
      $price_by_purchase      = $request['price_by_purchase'];
      $price_by_purchase_card = $request['price_by_purchase_card'];
      $path_to_img            = $request['path_to_img'];
      $in_stock               = $request['in_stock'];
      $availability           = $request['availability'];
 
      /*CHECK PRODUCT NAME*/
      $product_name = DB::table('products')
                        ->where('name', $name)
                        ->first();
      if(($product_name !== NULL) && ($product_name == $name))
        {
            return view('menu.shop.edit_product',[
              'alert_title' => 'Товар с таким именем уже существует! Проявите фантазию',
              'alert_text'  => 'Запись не добавлена',
              'alert_type'    => 'alert-error',
              'subcategories' => NULL,
              'category' => NULL
            ]);
        }
      DB::table('products')
        ->where('id', $id)
        ->update([
          'name' => $name,
          'short_description' => $short_description,
          'long_description' => $long_description,
          'subcategory_id' => $subcategory_id,
          'price' => $price,
          'price_by_card' => $price_by_card,
          'price_by_action' => $price_by_action,
          'price_by_purchase' => $price_by_purchase,
          'price_by_purchase_card' => $price_by_purchase_card,
          'path_to_img' => $path_to_img,
          'in_stock' => $in_stock,
          'availability' => $availability
          ]);
        /*----------------------*/
      return redirect()->back();
    }

    public function postAddProduct(Request $request)
    {
    	/*VALIDATING INPUT*/
      $this->validate($request,[
        'name' => 'required|min:1|max:255',
        'short_description' => 'required|min:1|max:255',
        'subcategory_id' => 'required',
        'price_by_supplier' => 'required|numeric',
        'price' => 'required|numeric',
        'price_by_card' => 'required|numeric',
        'price_by_action' => 'numeric',
        'price_by_purchase' => 'numeric',
        'price_by_purchase_card' => 'numeric',
        'path_to_img' => 'url',
        'in_stock' => 'required'
        ]);
      /*DEFAULT VALUES FOR VARIABLES*/
      $priority               = 4;
      $published              = 1;
      $price_by_action        = null;
      $price_by_purchase      = null;
      $price_by_purchase_card = null;
      $path_to_img = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=320%C3%97150&w=320&h=150';
      /*INIT VARIABLES*/
   /*   $published              = $request['published'];*/
      $name                   = $request['name'];
      $short_description      = $request['short_description'];
      $long_description       = $request['long_description'];

      $subcategory_id         = $request['subcategory_id'];
      
      $price_by_supplier      = $request['price_by_supplier'];
      $price                  = $request['price'];
      $price_by_card          = $request['price_by_card'];
      $price_by_action        = $request['price_by_action'];
      $price_by_purchase      = $request['price_by_purchase'];
      $price_by_purchase_card = $request['price_by_purchase_card'];
      $path_to_img            = $request['path_to_img'];
      $in_stock               = $request['in_stock'];
      $availability           = $request['availability'];
      $priority               = $request['priority'];
      

      $image = $request->file('image');
      $imagename = 'products/' . $this->str2url($request['name']) . '.jpg';
      if ($image){
        Storage::disk('public')->put($imagename, File::get($image));
        $path_to_img = 'http://etk-admin.ru/src/images/' . $imagename;
      }

      /*CHECK PRODUCT NAME*/
      $product_name = DB::table('products')
                        ->where('name', $name)
                        ->first();
      if($product_name !== NULL)
        {
            return view('menu.shop.add_product',[
              'alert_title' => 'Товар с таким именем уже существует! Проявите фантазию',
              'alert_text'  => 'Запись не добавлена',
              'alert_type'    => 'alert-error',
              'subcategories' => NULL,
              'category' => NULL
            ]);
        }
        /*----------------------*/

      if (DB::table('products')->insert([
        'name'                   => $name,
        'short_description'      => $short_description,
        'long_description'       => $long_description,
        'price_by_supplier'      => $price_by_supplier,
        'price'                  => $price,
        'price_by_card'          => $price_by_card,
        'price_by_action'        => $price_by_action,
        'price_by_purchase'      => $price_by_purchase,
        'price_by_purchase_card' => $price_by_purchase_card,
        'path_to_img'            => $path_to_img,
        'in_stock'               => $in_stock,
        'availability'           => $availability,
        'published'              => $published,
        'subcategory_id'         => $subcategory_id,
        'priority'               => $priority
        ]))   
      {return view('menu.shop.add_product',[
        'alert_title' => 'Запись добавлена',
        'alert_text'  => 'Добавлен новый товар',
        'alert_type'    => 'alert-success',
        'subcategories' => NULL,
        'category' => NULL
        ]);
      }
    }


    public function postDeleteProduct($id)
    {
    	DB::table('products')->where('id',$id)->delete();
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
