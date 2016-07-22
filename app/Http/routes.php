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
    Route::get('/auth/login', 'Auth\AuthController@getLogIn');
    Route::post('/auth/login', 'Auth\AuthController@postLogIn');
    Route::get('/auth/logout', 'Auth\AuthController@getLogOut');

    Route::get('/settings/users', [
    	'uses' => 'Auth\AuthController@getRegister',
		'as' => 'settings.users'
		]);

});
	Route::get('/dashboard', [
		'uses' => 'EmployeeController@getDashboard', 
		'as' => 'dashboard'
	]);
Route::group(['middleware' => ['auth']], function(){
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
});