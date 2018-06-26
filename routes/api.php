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
Route::get('client_registration_request', 'ClientApiController@index');
Route::post('client_login', 'ClientApiController@login');
Route::post('transporter_registration', 'TransporterApiController@registration');
Route::post('transporter_login', 'TransporterApiController@login');
Route::post('totalPrice', 'DeliveryApiController@totalPrice');
Route::post('distance', 'DeliveryApiController@distance');
Route::post('delivery_transporter_request', 'ClientApiController@transporterSearch');
Route::post('client_update', 'ClientApiController@update');
Route::post('delivery_service_response', 'ClientApiController@serviceResponse');
Route::post('delivery_service_request', 'TransporterApiController@serviceSearch');
Route::post('delivery_service_confirmation', 'TransporterApiController@transporterServiceConfirmation');


