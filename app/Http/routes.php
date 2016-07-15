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
Route::group(['middleware' => ['web']] , function() {

	Route::get('/{author?}' , [
	'uses' => 'HomeController@getHome',
	'as' => 'home'
	]);

	Route::post('/new' , [
	'uses' => 'QuoteController@postQuote',
	'as' => 'create'
	]);

	Route::get('/delete/{quote_id}' , [
	'uses' => 'QuoteController@getDeleteQuote',
	'as' => 'delete'
	]);

	Route::get('/gotemail/{author_name}' , [
		'uses' => 'QuoteController@getMailCallback',
		'as' => 'mail_callback'
	]);

	Route::get('/admin/login' , [
		'uses' => 'AdminController@getLogin',
		'as' => 'admin.login'
	]);

	Route::post('/admin/login' , [
		'uses' => 'AdminController@postLogin',
		'as' => 'admin.login'
	]);

	Route::get('/admin/dashboard' , [
		'uses' => 'AdminController@getDashboard',
		'as' => 'admin.dashboard'
	]);


});


