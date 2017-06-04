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
	// Authentication Routes...
	Auth::routes();
	//Route to  display the links list
	Route::get('/all-links', 'LinkShortenerController@linksList')->name('all-links');
	
	//Route to  display only user's links  list
	Route::get('/my-links', 'LinkShortenerController@userLinks')->name('user-links');

	// Routes to create and return a shortened URL given a long URL
	Route::get('/', 'LinkShortenerController@getForm')->name('get-form');
	Route::post('/', 'LinkShortenerController@postForm')->name('post-form');

	//Route to delete a specific link by {id}
	Route::delete('/link/{id}', 'LinkShortenerController@deleteLink')->name('delete-link');
});

