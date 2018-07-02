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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/delivery', 'DeliveryController');
Route::resource('/client', 'ClientController');
Route::resource('/dashboard', 'DashboardController');
Route::resource('/transporter', 'TransporterController');
Route::get('/transporter/show/{id}', 'TransporterController@show');
Route::get('/client/show/{id}', 'clientController@show');



Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
