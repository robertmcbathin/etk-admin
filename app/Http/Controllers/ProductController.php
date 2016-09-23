<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   public function getAddSection()
    {
      return view('menu.shop.add_section',[
        'alert_title' => '',
            'alert_text'  => '',
            'alert_type'    => ''
        ]);
    }
    public function postAddSection(Request $request)
    {
      /*VALIDATING INPUT*/
      $this->validate($request,[
        'section_name' => 'required'
        ]);
      /*INIT VARIABLES*/
      $section_name  = $request['section_name'];
      $section_description = $request['section_description'];
      $section_image = $request['section_image'];

      /*CHECK CARD CREDENTIALS*/
      $section = DB::table('sections')->where('title',$section_name)
                                  ->first();
        if($section !== NULL)
        {
            return view('menu.shop.add_section',[
              'alert_title' => 'Такой раздел уже существует!',
              'alert_text'  => 'Запись не добавлена',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*----------------------*/

      if (DB::table('sections')->insert([
        'title'            => $section_name,
        'description'      => $section_description,
        'image' => $section_image
        ]))
      {return view('menu.shop.add_section',[
        'alert_title' => 'Запись добавлена',
        'alert_text'  => 'Добавлена новый раздел',
        'alert_type'    => 'alert-success'
        ]);
      }
    }

    public function getEditSection($section_id)
    {
      $section = DB::table('sections')
              ->where('id', $section_id)
              ->first();
      return view('menu.shop.edit_section',[
        'section' => $section,
        'alert_title' => '',
        'alert_type'    => ''
        ]);
    }
    public function postEditSection(Request $request)
    {
      /*VALIDATING INPUT*/
      $this->validate($request,[
        'section_title' => 'required'
        ]);
      /*INIT VARIABLES*/
      $section_name  = $request['section_name'];
      $section_id  = $request['section_id'];
      $section_description  = $request['section_description'];
      $section_image  = $request['section_image'];

      /*CHECK CARD CREDENTIALS*/
      $section = DB::table('sections')->where('title',$section_name)
                                  ->first();
        if($section !== NULL)
        {
            return view('menu.shop.edit_section',[
              'section'   => $section,
              'alert_title' => 'Зачем сохранять то же название?!',
              'alert_text'  => 'Название раздела не изменено',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*----------------------*/

      if (DB::table('sections')
                   ->where('id',$section_id)
                   ->update(['title' => $section_name
        ]))
      {
        $section = DB::table('sections')
                  ->where('id',$section_id)
                  ->first();
        return view('menu.shop.edit_section',[
        'section'   => $section,
        'alert_title' => 'Запись изменена',
        'alert_text'  => 'Название раздела изменено',
        'alert_type'    => 'alert-success'
        ]);
      }
    }

    public function showSections()
    {
      $sections = DB::table('sections')
                          ->orderBy('id', 'asc')
                          ->get();

      return view('menu.shop.sections',[
        'sections' => $sections
        ]);
    }
    public function postDeleteSection($id)
    {
      DB::table('sections')->where('id',$id)->delete();
      return redirect()->back();
    }

    /*categories*/
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
      {
        $category = DB::table('categories')
                  ->where('id',$category_id)
                  ->first();
        return view('menu.shop.edit_category',[
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
      					  ->select('subcategories.id', 
                    'subcategories.name',
                    'categories.name as category_name',
                    'subcategories.updated_at',
                    'subcategories.created_at',
                    'subcategories.is_show')
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
    public function getUnlockCategory($id)
    {
      DB::table('categories')
                ->where('id', $id)
                ->update(['is_show' => 1]);
      return redirect()->back();
    }
    public function getLockCategory($id)
    {
      DB::table('categories')
                ->where('id', $id)
                ->update(['is_show' => 0]);
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
    public function getUnlockSubCategory($id)
    {
      DB::table('subcategories')
                ->where('id', $id)
                ->update(['is_show' => 1]);
      return redirect()->back();
    }
    public function getLockSubCategory($id)
    {
      DB::table('subcategories')
                ->where('id', $id)
                ->update(['is_show' => 0]);
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
      $available_tags = DB::table('product_tags')
                      ->where('subcategory_id', $subcategory_id)
                      ->get();
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
            'category' => $category,
            'tags' => $tags,
            'available_tags' => $available_tags
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
      $priority               = 4;
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
      $keywords               = $request['keywords'];
      $description            = $request['description'];
      
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
          'price_by_supplier' => $price_by_supplier,
          'price' => $price,
          'price_by_card' => $price_by_card,
          'price_by_action' => $price_by_action,
          'price_by_purchase' => $price_by_purchase,
          'price_by_purchase_card' => $price_by_purchase_card,
          'path_to_img' => $path_to_img,
          'in_stock' => $in_stock,
          'availability' => $availability,
          'priority'               => $priority,
          'keywords'               => $keywords,
        'description'            => $description
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
      $keywords               = $request['keywords'];
      $description            = $request['description'];
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
        'priority'               => $priority,
        'keywords'               => $keywords,
        'description'            => $description
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

    /*---TAGS----*/
    /*-----------*/
    /*-----------*/
    /*-----------*/
    public function getAddTag()
    {
      $subcategories = DB::table('subcategories')
              ->get();
      return view('menu.shop.add_tag',[
        'alert_title' => '',
            'alert_text'  => '',
            'alert_type'    => '',
            'subcategories' => $subcategories
        ]);
    }
    public function postAddTag(Request $request)
    {
      /*VALIDATING INPUT*/
      $this->validate($request,[
        'tag_name' => 'required',
        'subcategory_id' => 'required'
        ]);
      /*INIT VARIABLES*/
      $tag_name  = $request['tag_name'];
      $subcategory_id = $request['subcategory_id'];
      $subcategories = DB::table('subcategories')
              ->get();
      /*CHECK CARD CREDENTIALS*/
      $tag = DB::table('product_tags')->where('name',$tag_name)
                                  ->first();
        if($tag !== NULL)
        {
            return view('menu.shop.add_tag',[
              'alert_title' => 'Такой тег уже существует!',
              'alert_text'  => 'Запись не добавлена',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*----------------------*/

      if (DB::table('product_tags')->insert([
        'name'            => $tag_name,
        'subcategory_id' => $subcategory_id
        ]))
      {return view('menu.shop.add_tag',[
        'alert_title' => 'Запись добавлена',
        'alert_text'  => 'Добавлен новый тег',
        'alert_type'    => 'alert-success',
        'subcategories' => $subcategories
        ]);
      }
    }

    public function getEditTag($tag_id)
    {
      $Tag = DB::table('product_tags')
              ->where('id', $tag_id)
              ->first();
      return view('menu.shop.edit_tag',[
        'Tag' => $Tag,
        'alert_title' => '',
        'alert_type'    => ''
        ]);
    }
    public function postEditTag(Request $request)
    {
      /*VALIDATING INPUT*/
      $this->validate($request,[
        'tag_name' => 'required'
        ]);
      /*INIT VARIABLES*/
      $tag_name  = $request['tag_name'];
      $tag_id  = $request['tag_id'];

      /*CHECK TAG*/
      $tag = DB::table('product_tags')->where('name',$tag_name)
                                  ->first();
        if($tag !== NULL)
        {
            return view('menu.shop.edit_tag',[
              'tag'   => $tag,
              'alert_title' => 'Зачем сохранять то же название?!',
              'alert_text'  => 'Название тега не изменено',
              'alert_type'    => 'alert-error'
            ]);
        }
        /*----------------------*/

      if (DB::table('product_tags')
                   ->where('id',$tag_id)
                   ->update(['name' => $tag_name
        ]))
      {
        $tag = DB::table('product_tags')
                  ->where('id',$tag_id)
                  ->first();
        return view('menu.shop.edit_tag',[
        'tag'   => $tag,
        'alert_title' => 'Запись изменена',
        'alert_text'  => 'Название тега изменено',
        'alert_type'    => 'alert-success'
        ]);
      }
    }

    public function showTags()
    {
      $tags = DB::table('product_tags')
                ->join('subcategories', 'product_tags.subcategory_id', '=', 'subcategories.id')
                ->select('product_tags.id', 
                         'product_tags.name', 
                         'subcategories.name as subcategory_name')
                ->get();

      return view('menu.shop.tags',[
        'tags' => $tags
        ]);
    }
    public function postDeleteTag($id)
    {
      DB::table('product_tags')->where('id',$id)->delete();
      return redirect()->back();
    }
    public function postRemoveTag($tag_id, $product_id)
    {
      DB::table('product-tag')
        ->where('tag_id',$tag_id)
        ->where('product_id', $product_id)
        ->delete();
      return redirect()->back();
    }
    public function postAddTagToProduct(Request $request)
    {
      $tag_id = $request['tag_id'];
      $product_id = $request['product_id'];


      DB::table('product-tag')
               ->insert(['product_id' => $product_id, 
                          'tag_id' => $tag_id]);
      return redirect()->back();
    }
}
