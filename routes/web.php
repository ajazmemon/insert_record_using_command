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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ajax_list', 'HomeController@ajax_list')->name('ajax_list');

Route::get('/profile', function(){
	return 'This is profile';
})->middleware('verified');
