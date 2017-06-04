<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/all-links', 'LinkShortenerController@linksList');

Route::group(['middleware' => ['trackUserNavigation']], function(){
	Auth::routes();

	Route::group(['prefix' => '{lang?}'], function () {

		Route::get('/my-links', 'LinkShortenerController@userLinks');
		Route::get('/', 'LinkShortenerController@getForm');
		Route::post('/', 'LinkShortenerController@postForm');
		Route::delete('/link/{id}', 'LinkShortenerController@deleteLink');
		// Route::get('/home', 'HomeController@index')->name('home');
	});
});

