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
Route::post('checkAvailability', 'SearchController@CheckAvailability'); 
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('reservation', 'SearchController@reservation');
// Route::post('addtoCart/{id}', 'SearchController@Addtocart');

//Admin Route
Route::get('admin', 'AdminController@Index');
Route::get('bookings', 'AdminController@Bookings');
