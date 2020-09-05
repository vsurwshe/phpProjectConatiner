<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api/users', 'middleware' => 'cors'],function($router){
    $router->get('getAllUsers','UsersController@getAllUsers');
    $router->get('getUsers/{id}','UsersController@getUsersById');
    $router->post('saveUsers','UsersController@create');
    $router->put('updateUsers/{id}','UsersController@updateUser');
    $router->delete('deleteUsers/{id}','UsersController@deleteUser');
});
