<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function(){
	Route::get('/', function(){
		return view('auth.login');
	})->name('home');

    // Маршруты аутентификации...
    Route::get('/login',  'EmployeeController@getLogIn');
    Route::post('/login', 'EmployeeController@postLogIn');
    Route::get('/logout', 'EmployeeController@getLogOut');

});
Route::group(['middleware' => ['auth']], function(){

    Route::get('/settings/users', [
    	'uses' => 'EmployeeController@getUserList',
		'as' => 'settings.users'
		]);

	Route::get('/dashboard', [
		'uses' => 'EmployeeController@getDashboard', 
		'as' => 'dashboard'
	]);

	/* CARD ROUTES */
	Route::get('/club/cards', ['uses' => 
		'CardController@showCardDashboard',
		'as' => 'club.cards'
		]);
	Route::get('/club/cards/add', ['uses' => 
		'CardController@getCardAdd',
		'as' => 'club.cards.add.get'
		]);
	Route::post('/club/cards/add', ['uses' => 
		'CardController@postCardAdd',
		'as' => 'club.cards.add.post'
		]);
	Route::get('/club/cards/queue', ['uses' => 
		'CardController@showCardActivationQueue',
		'as' => 'club.cards.queue'
		]);
	Route::get('/club/cards/activated', ['uses' => 
		'CardController@showActivatedCards',
		'as' => 'club.cards.activated'
		]);
	Route::get('/club/cardholders/list', ['uses' => 
		'CardholderController@showCardholderList',
		'as' => 'club.cardholders.list'
		]);
	Route::get('/club/cardholders/add', ['uses' => 
		'CardholderController@getCardholderAdd',
		'as' => 'club.cardholders.add.get'
		]);
	Route::post('/club/cardholders/add', ['uses' => 
		'CardholderController@postCardholderAdd',
		'as' => 'club.cardholders.add.post'
		]);

	/*SHOP ROUTES*/
	/*CATEGORIES*/
	Route::get('/shop/categories', ['uses' => 
		'ProductController@showCategories',
		'as' => 'shop.categories'
		]);	
	Route::get('/shop/categories/add', ['uses' => 
		'ProductController@getAddCategory',
		'as' => 'shop.categories.add.get'
		]);	
	Route::post('/shop/categories/add', ['uses' => 
		'ProductController@postAddCategory',
		'as' => 'shop.categories.add.post'
		]);	
	Route::get('/shop/categories/{id}/delete', ['uses' => 
		'ProductController@postDeleteCategory',
		'as' => 'shop.categories.delete.post'
		]);	
	/*SUBCATEGORIES*/
	Route::get('/shop/categories/subcategory/add', ['uses' => 
		'ProductController@getAddSubCategory',
		'as' => 'shop.categories.subcategory.add.get'
		]);	
	Route::post('/shop/categories/subcategory/add', ['uses' => 
		'ProductController@postAddSubCategory',
		'as' => 'shop.categories.subcategory.add.post'
		]);	
	Route::get('/shop/categories/subcategory/{id}/delete', ['uses' => 
		'ProductController@postDeleteSubCategory',
		'as' => 'shop.categories.subcategory.delete.post'
		]);
	/*PRODUCTS*/
	Route::get('/shop/products', ['uses' => 
		'ProductController@showProducts',
		'as' => 'shop.products'
		]);	
	Route::get('/shop/products/{id}/delete', ['uses' => 
		'ProductController@postDeleteProduct',
		'as' => 'shop.products.delete.post'
		]);	
	Route::get('/shop/products/{id}/unlock', ['uses' => 
		'ProductController@postUnlockProduct',
		'as' => 'shop.products.unlock.get'
		]);	
	Route::get('/shop/products/{id}/lock', ['uses' => 
		'ProductController@postLockProduct',
		'as' => 'shop.products.lock.get'
		]);	
	Route::get('/shop/products/{category_id}/add', ['uses' => 
		'ProductController@getAddProduct',
		'as' => 'shop.products.add.get'
		]);	
	Route::get('/shop/products/{category_id}/{subcategory_id}/{id}/edit', ['uses' => 
		'ProductController@getEditProduct',
		'as' => 'shop.products.edit.get'
		]);	
	Route::post('/shop/products/{id}/edit', ['uses' => 
		'ProductController@postEditProduct',
		'as' => 'shop.products.edit.post'
		]);	
	Route::post('/shop/products/add', ['uses' => 
		'ProductController@postAddProduct',
		'as' => 'shop.products.add.post'
		]);	
});