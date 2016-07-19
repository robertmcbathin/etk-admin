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
	Route::get('/', [
		'uses' => 'EmployeeController@getDashboard', 
		'as' => '/'
	]);
	Route::get('/dashboard', [
		'uses' => 'EmployeeController@getDashboard', 
		'as' => 'dashboard'
	]);
	Route::get('/club/cards', ['uses' => 
		'CardController@showCardDashboard',
		'as' => 'club.cards'
		]);

    // Маршруты аутентификации...
    Route::get('auth/login', 'Auth\AuthController@getLogIn');
    Route::post('auth/login', 'Auth\AuthController@postLogIn');
    Route::get('auth/signout', 'Auth\AuthController@getSignOut');

    Route::get('/settings/users', [
    	'uses' => 'Auth\AuthController@getRegister',
		'as' => 'settings.users'
		]);

});