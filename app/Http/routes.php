<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('/xhprof', [
	'as' => 'xhprof', 'uses' => 'WelcomeController@xhprof_list'
]);

Route::get('/xhprof_detail/{id?}', [
	'as' => 'xhprof_detail', 'uses' => 'WelcomeController@xhprof_detail'
]);

Route::get('/config', 'ConfigController@index');

Route::post('/config/add', 'ConfigController@add');

Route::post('/config/delete', 'ConfigController@delete');

Route::get('/rabbit', 'RabbitController@index');

Route::get('/rabbit/receive', 'RabbitController@receive');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
