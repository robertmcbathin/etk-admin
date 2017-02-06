<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function getArticleDashboard()
    {
      $articles = DB::table('articles')
                          ->orderBy('created_at', 'asc')
                          ->get();

      return view('menu.etk.articles',[
        'articles' => $articles
        ]);
    }

    public function getArticleAdd()
    {
    	return view('menu.etk.add_article');
    }


    public function postArticleAdd(Request $request)
    {
    	/*VALIDATING INPUT*/
      $this->validate($request,[
        'article_title' => 'required|min:1|max:255',
        'article_short_content' => 'required|min:1|max:255',
        'article_content' => 'required|min:1|max:255',
        'path_to_img' => 'url',
        'path_to_thumbnail' => 'url'
        ]);
      /*DEFAULT VALUES FOR VARIABLES*/
      $path_to_img = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=320%C3%97150&w=470&h=365';
      $path_to_thumbnail = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=320%C3%97150&w=235&h=180';
      /*INIT VARIABLES*/
      $published              = 1;//$request['published'];
      $article_title                   = $request['article_title'];
      $article_short_content      = $request['article_short_content'];
      $article_content       = $request['article_content'];
      $path_to_img            = $request['path_to_img'];
      $path_to_thumbnail            = $request['path_to_thumbnail'];
      $user = Auth::user()->id;
      $image = $request->file('image');
      $imagename = 'articles/' . $this->str2url($request['title']) . '.jpg';
      if ($image){
        Storage::disk('public')->put($imagename, File::get($image));
        $path_to_img = 'http://etk-admin.ru/src/images/' . $imagename;
      }

      $thumbnail = $request->file('thumbnail');
      $thumbnailname = 'articles/thumbnails/' . $this->str2url($request['title']) . '_thumb.jpg';
      if ($thumbnail){
        Storage::disk('public')->put($thumbnailname, File::get($thumbnail));
        $path_to_thumbnail = 'http://etk-admin.ru/src/images/' . $thumbnailname;
      }
      /*insert into database*/

      if (DB::table('articles')->insert([
        'title'                  => $article_title,
        'content_short'          => $article_short_content,
        'content'                => $article_content,
        'image'                  => $path_to_img,
        'thumbnail_image'        => $path_to_thumbnail,
        'published'              => $published,
        ]))   
      {return redirect()->back();
      }
  }
}
