<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Controller;


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

Route::get("temp",'AuthController@getTest');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([
    'prefix' => 'store',
    'middleware' => 'auth:api'
], function() {
    Route::get('list', 'StoreController@getAllStoreElements');
    Route::post('save', 'StoreController@saveStoreElementRecord');
    Route::put('update/{productId}', 'StoreController@updateStoreElementRecord');
    Route::delete('delete/{productId}', 'StoreController@deleteStoreElementRecord');
});