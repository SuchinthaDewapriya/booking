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
Route::get('reservations', 'AdminController@Reservations');
Route::get('rooms', 'AdminController@Rooms');
Route::get('packages', 'AdminController@Packages');

Route::post('add-new-room', 'AdminController@AddNewRoom'); 
Route::get('delete-all-rooms', 'AdminController@DeleteAllRooms'); 
Route::get('room-delete/{id}', 'AdminController@RoomDelete'); 
Route::get('edit-room/{id}', 'AdminController@RoomEdit'); 

Route::post('add-new-package', 'AdminController@AddNewPackage'); 
Route::get('delete-all-packages', 'AdminController@DeleteAllPackage'); 
Route::get('package-delete/{id}', 'AdminController@PackageDelete'); 
Route::get('edit-package/{id}', 'AdminController@PackageEdit'); 
