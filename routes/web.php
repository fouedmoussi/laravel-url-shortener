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


Route::group(['middleware' => ['trackUserNavigation']], function(){
	Auth::routes();
	Route::get('/all-links', 'LinkShortenerController@linksList')->name('all-links');
	Route::get('/my-links', 'LinkShortenerController@userLinks')->name('user-links');
	Route::get('/', 'LinkShortenerController@getForm')->name('get-form');
	Route::post('/', 'LinkShortenerController@postForm')->name('post-form');
	Route::delete('/link/{id}', 'LinkShortenerController@deleteLink')->name('delete-link');
	// Route::get('/home', 'HomeController@index')->name('home');
});

