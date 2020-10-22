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

Route::group([
    'prefix' => 'table',
    'middleware' => 'auth:api'
], function() {
    Route::get('list', 'HotelTableController@show');
    Route::post('save', 'HotelTableController@store');
    Route::put('update/{tableId}', 'HotelTableController@update');
    Route::delete('delete/{tableId}', 'HotelTableController@destroy');
});

Route::group([
    'prefix' => 'food',
    'middleware' => 'auth:api'
], function() {
    Route::get('list', 'FoodController@show');
    Route::post('save', 'FoodController@store');
    Route::put('update/{tableId}', 'FoodController@update');
    Route::delete('delete/{tableId}', 'FoodController@destroy');
});


Route::group([
    'prefix' => 'invoice',
    'middleware' => 'auth:api'
], function() {
    Route::get('list', 'InvoiceController@show');
    Route::post('save', 'InvoiceController@store');
    Route::put('update/{tableId}', 'InvoiceController@update');
    Route::delete('delete/{tableId}', 'InvoiceController@destroy');
});

Route::group([
    'prefix' => 'orders/table',
    'middleware' => 'auth:api'
], function() {
    Route::get('freeTabelList', 'FreeTabelController@show');
    Route::get('bookedTabelList', 'BookedTabelController@show');
    Route::post('save', 'BookedTabelController@store');
    Route::put('update/{tableId}', 'BookedTabelController@update');
    Route::delete('delete/{tableId}', 'BookedTabelController@destroy');
});

Route::group([
    'prefix' => 'orders/food',
    'middleware' => 'auth:api'
], function() {
    Route::get('list/{tableId}', 'OrderFoodController@getOrdersByTabelId');
    Route::post('save', 'OrderFoodController@store');
    Route::put('update/{tableId}', 'OrderFoodController@update');
    Route::delete('delete/{tableId}', 'OrderFoodController@destroy');
});