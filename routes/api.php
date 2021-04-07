<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1'], function () {

    Route::post('register', 'DeviceController@store');

    Route::group( ['middleware' => ['auth:sanctum']], function(){

    });


});


Route::group(['prefix' => 'mock', 'as' => 'api.', 'namespace' => 'Mock'], function () {

    Route::post('google/verification', 'GoogleReceiptVerificationController@verification');
    Route::post('apple/verification', 'AppleReceiptVerificationController@verification');


});
