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

//Booking Routes
Route::post('confirm-order', 'BookingController@ConfirmOrder');
Route::post('storeData', 'BookingController@BookingTable'); 

//Admin Route
Route::get('admin', 'AdminController@Index');
Route::get('reservations', 'AdminController@Reservations');
Route::get('rooms', 'AdminController@Rooms');
Route::get('packages', 'AdminController@Packages');

Route::post('add-new-room', 'AdminController@AddNewRoom'); 
Route::get('delete-all-rooms', 'AdminController@DeleteAllRooms'); 
Route::get('room-delete/{id}', 'AdminController@RoomDelete'); 
Route::get('edit-room/{id}', 'AdminController@RoomEdit'); 
Route::post('update-room', 'AdminController@RoomUpdate');

Route::post('add-new-package', 'AdminController@AddNewPackage'); 
Route::get('delete-all-packages', 'AdminController@DeleteAllPackages'); 
Route::get('package-delete/{id}', 'AdminController@PackageDelete'); 
Route::get('edit-package/{id}', 'AdminController@PackageEdit'); 
Route::post('update-package', 'AdminController@PackageUpdate'); 

Route::get('view-reservation/{id}', 'AdminController@ViewReservation'); 
