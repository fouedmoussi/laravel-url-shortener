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

Auth::routes();
Route::get('/', 'LinkShortenerController@getForm');
Route::post('/', 'LinkShortenerController@postForm');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/en', function(){
	session(['locale' => 'en']);
	return redirect()->back();
});

Route::get('/fr', function(){
	session(['locale' => 'fr']);
	return redirect()->back();
});