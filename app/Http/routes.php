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
Route::get('/date', [
	'uses' => 'CardController@checkDate'
	]);
Route::group(['middleware' => ['auth']], function(){

    Route::get('/settings/users', [
    	'uses' => 'EmployeeController@getUserList',
		'as' => 'settings.users'
		]);

	Route::get('/dashboard', [
		'uses' => 'EmployeeController@getDashboard', 
		'as' => 'dashboard'
	]);

	/* CARD ROUTES 
	----------------	
    ----------------
    ----------------
	*/
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
	/*CARDHOLDERS
	----------------	
    ----------------
    ----------------
	*/
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
	Route::get('/club/{cardholder_id}/edit', ['uses' => 
		'CardholderController@getEditCardholder',
		'as' => 'club.cardholders.edit.get'
		]);	
	Route::post('/club/cardholders/{cardholder_id}/edit', ['uses' => 
		'CardholderController@postEditCardholder',
		'as' => 'club.cardholders.edit.post'
		]);	
	Route::get('/club/cardholders/{cardholder_id}/delete', ['uses' => 
		'CardholderController@getDeleteCardholder',
		'as' => 'club.cardholders.delete.get'
		]);	
	Route::get('/club/cardholders/{cardholder_id}/unlock', ['uses' => 
		'CardholderController@getUnlockCardholder',
		'as' => 'club.cardholders.unlock.get'
		]);	
	Route::get('/club/cardholders/{cardholder_id}/lock', ['uses' => 
		'CardholderController@getLockCardholder',
		'as' => 'club.cardholders.lock.get'
		]);

	/*SHOP ROUTES*/
	/*CATEGORIES
    ----------------	
    ----------------
    ----------------
	*/
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
	Route::get('/shop/categories/{id}/edit', ['uses' => 
		'ProductController@getEditCategory',
		'as' => 'shop.categories.edit.get'
		]);	
	Route::post('/shop/categories/{id}/edit', ['uses' => 
		'ProductController@postEditCategory',
		'as' => 'shop.categories.edit.post'
		]);	
	Route::get('/shop/categories/{id}/delete', ['uses' => 
		'ProductController@postDeleteCategory',
		'as' => 'shop.categories.delete.post'
		]);	
	Route::get('/shop/categories/{id}/unlock', ['uses' => 
		'ProductController@getUnlockCategory',
		'as' => 'club.categories.unlock.get'
		]);	
	Route::get('/shop/categories/{id}/lock', ['uses' => 
		'ProductController@getLockCategory',
		'as' => 'club.categories.lock.get'
		]);
	/*SUBCATEGORIES
    ----------------	
    ----------------
    ----------------
	*/
	Route::get('/shop/categories/subcategory/add', ['uses' => 
		'ProductController@getAddSubCategory',
		'as' => 'shop.categories.subcategory.add.get'
		]);	
	Route::post('/shop/categories/subcategory/add', ['uses' => 
		'ProductController@postAddSubCategory',
		'as' => 'shop.categories.subcategory.add.post'
		]);	
	Route::get('/shop/categories/subcategory/{id}/edit', ['uses' => 
		'ProductController@getEditSubCategory',
		'as' => 'shop.categories.subcategory.edit.get'
		]);	
	Route::post('/shop/categories/subcategory/{id}/edit', ['uses' => 
		'ProductController@postEditSubCategory',
		'as' => 'shop.categories.subcategory.edit.post'
		]);	
	Route::get('/shop/categories/subcategory/{id}/delete', ['uses' => 
		'ProductController@postDeleteSubCategory',
		'as' => 'shop.categories.subcategory.delete.post'
		]);
	Route::get('/shop/categories/subcategory/{id}/unlock', ['uses' => 
		'ProductController@getUnlockSubCategory',
		'as' => 'club.categories.unlock.get'
		]);	
	Route::get('/shop/categories/subcategory/{id}/lock', ['uses' => 
		'ProductController@getLockSubCategory',
		'as' => 'club.categories.lock.get'
		]);
	/*----------------	
    ----------------
    ----------------
	*/
    /*BANNERS
    ----------------	
    ----------------
    ----------------
	*/
    Route::get('/shop/banners', ['uses' => 
		'BannerController@showBanners',
		'as' => 'shop.banners'
		]);	
	Route::get('/shop/banners/add', ['uses' => 
		'BannerController@getAddBanner',
		'as' => 'shop.banners.add.get'
		]);	
	Route::post('/shop/banners/add', ['uses' => 
		'BannerController@postAddBanner',
		'as' => 'shop.banners.add.post'
		]);	
	Route::get('/shop/banners/{id}/edit', ['uses' => 
		'BannerController@getEditBanner',
		'as' => 'shop.banners.edit.get'
		]);	
	Route::post('/shop/banners/{id}/edit', ['uses' => 
		'BannerController@postEditBanner',
		'as' => 'shop.banners.edit.post'
		]);	
	Route::get('/shop/banners/{id}/delete', ['uses' => 
		'BannerController@postDeleteBanner',
		'as' => 'shop.banners.delete.post'
		]);
	/*----------------	
    ----------------
    ----------------
	*/
	/*PRODUCTS
	----------------	
    ----------------
    ----------------
	*/
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
	/*----------------	
    ----------------
    ----------------
	*/
	/*MANUFACTURERS
	----------------	
    ----------------
    ----------------
	*/
	Route::get('/shop/manufacturers', ['uses' => 
		'ManufacturerController@showManufacturers',
		'as' => 'shop.manufacturers'
		]);	
	Route::get('/shop/manufacturers/add', ['uses' => 
		'ManufacturerController@getAddManufacturer',
		'as' => 'shop.manufacturers.add.get'
		]);	
	Route::post('/shop/manufacturers/add', ['uses' => 
		'ManufacturerController@postAddManufacturer',
		'as' => 'shop.manufacturers.add.post'
		]);	
	Route::get('/shop/manufacturers/{id}/edit', ['uses' => 
		'ManufacturerController@getEditManufacturer',
		'as' => 'shop.manufacturers.edit.get'
		]);	
	Route::post('/shop/manufacturers/{id}/edit', ['uses' => 
		'ManufacturerController@postEditManufacturer',
		'as' => 'shop.manufacturers.edit.post'
		]);	
	Route::get('/shop/manufacturers/{id}/delete', ['uses' => 
		'ManufacturerController@postDeleteManufacturer',
		'as' => 'shop.manufacturers.delete.post'
		]);	
	/*----------------	
    ----------------
    ----------------
	*/
/*ORDERS
	----------------	
    ----------------
    ----------------
	*/
	Route::get('/shop/orders', ['uses' => 
		'OrderController@showOrders',
		'as' => 'shop.orders'
		]);	
	Route::get('/shop/orders/add', ['uses' => 
		'OrderController@getAddOrder',
		'as' => 'shop.orders.add.get'
		]);	
	Route::post('/shop/orders/add', ['uses' => 
		'OrderController@postAddOrder',
		'as' => 'shop.orders.add.post'
		]);	
	Route::get('/shop/orders/{id}/edit', ['uses' => 
		'OrderController@getEditOrder',
		'as' => 'shop.orders.edit.get'
		]);	
	Route::post('/shop/orders/{id}/edit', ['uses' => 
		'OrderController@postEditOrder',
		'as' => 'shop.orders.edit.post'
		]);	
	Route::get('/shop/orders/{id}/delete', ['uses' => 
		'OrderController@postDeleteOrder',
		'as' => 'shop.orders.delete.post'
		]);	
	/*----------------	
    ----------------
    ----------------
	*/
	/*CALLBACKS
	----------------	
    ----------------
    ----------------
	*/
	Route::get('/shop/callbacks', ['uses' => 
		'UserController@showCallbacks',
		'as' => 'shop.callbacks.show'
		]);	
	Route::get('/shop/callbacks/{id}/{user_id}/process', ['uses' => 
		'UserController@getProcessCallback',
		'as' => 'shop.callbacks.process.get'
		]);	
	Route::get('/shop/callbacks/{id}/{user_id}/done', ['uses' => 
		'UserController@getDoneCallback',
		'as' => 'shop.callbacks.done.get'
		]);	
	/*----------------	
    ----------------
    ----------------
	*/
	/*AJAX
	----------------	
    ----------------
    ----------------
	*/
	Route::post('/ajax/check_card_credentials', [ 'uses' =>
		'CardController@ajaxCheckCardCredentials',
		'as' => 'ajax.check_card_credentials'
		]);
	Route::get('/update', [
		'uses' => 'CardController@update',
		'as'   => 'update'
		]);
});