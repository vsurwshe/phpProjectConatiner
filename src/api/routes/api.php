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

Route::group(['prefix' => 'student', 'middleware' => 'cors'], function () {
    Route::get('getAll', 'StudentController@getAllStudents');
    Route::get('getById/{id}', 'StudentController@getStudent');
    Route::post('create', 'StudentController@createStudent');
    Route::put('update/{id}', 'StudentController@updateStudent');
    Route::delete('delete/{id}','StudentController@deleteStudent');
});


