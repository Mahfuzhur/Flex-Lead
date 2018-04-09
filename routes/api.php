<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('delivery_request', 'DeliveryApiController@index');
Route::get('delivery_request/{id}', 'DeliveryApiController@show');
Route::post('delivery_request', 'DeliveryApiController@store');
Route::put('delivery_request/{id}', 'DeliveryApiController@update');
Route::delete('delivery_request/{id}', 'DeliveryApiController@delete');
Route::post('delivery_request_transporter', 'DeliveryApiController@transporter');
// client api route
Route::post('client_registration_request', 'ClientApiController@Registration');