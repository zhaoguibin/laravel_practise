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

Route::get('/home', 'HomeController@index');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/user', 'UserController@index');
    Route::post('/user', 'UserController@index');
    Route::post('/add', 'UserController@store');
    Route::get('/destroy/{id}','UserController@destroy');
    Route::get('/delete/{id}','UserController@delete');
    Route::get('/restore/{id}','UserController@restore');
});
