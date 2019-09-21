<?php

/*\App\Owner::created(function ($owner) {
	
	\App\Activity::create([
		
		'owner_id' => $owner->id,

		'explanation' => 'created'

	]);
});

\App\Owner::updated(function ($owner) {
	
	\App\Activity::create([
		
		'owner_id' => $owner->id,

		'explanation' => 'updated'

	]);
});*/

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function () {

	// Route::get('/owners', 'OwnersController@index');

	// Route::get('/owners/create', 'OwnersController@create');

	// Route::get('/owners/{owner}', 'OwnersController@show');

	// Route::get('/owners/{owner}/edit', 'OwnersController@edit');

	// Route::patch('/owners/{owner}', 'OwnersController@update');

	// Route::post('/owners', 'OwnersController@store');

	// Route::delete('/owners/{owner}', 'OwnersController@destroy');

	Route::resource('owners', 'OwnersController');

	Route::post('/owners/{owner}/specifics', 'OwnerSpecificsController@store');

	Route::patch('/owners/{owner}/specifics/{specific}',

		'OwnerSpecificsController@update');

	Route::post('/owners/{owner}/invitations', 'OwnerInvitationsController@store');

	Route::get('/home', 'HomeController@index')->name('home');
});




Auth::routes();


