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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {

    Route::resource('tenants', 'LocataireControler');

    Route::resource('bien', 'BienController');

    Route::resource('rentale', 'LocationController');

    Route::resource('payment', 'PaymentController');

    Route::resource('state', 'EtatController');

    Route::get('/pays', 'PaysController@getpays')->name('pays');

});
