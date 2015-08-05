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

Route::get('/', function(){
    return view('auth.login');
});

Route::get('/home', ['middleware' => 'auth', 'uses' => 'HomeController@index']);

Route::group(['middleware' => 'auth', 'prefix' => 'arq'], function(){
    Route::get('', 'ArquivoController@index');
    Route::get('create', 'ArquivoController@create');
    Route::get('find/{id}', 'ArquivoController@find');
    Route::get('listAll', 'ArquivoController@listAll');
    Route::post('search', 'ArquivoController@search');
    Route::post('update', 'ArquivoController@onUpdate');
    Route::get('delete/{id}', 'ArquivoController@onDelete');
});

Route::group(['middleware' => 'auth','prefix' => 'adm'], function(){
    Route::get('find/{id}', 'AdmController@find');
    Route::get('listAll', 'AdmController@listAll');
    Route::post('search', 'AdmController@search');
    Route::post('update', 'AdmController@onUpdate');
    Route::post('create', 'AdmController@onCreate');
    Route::post('auth', 'AdmController@onAuth');
    Route::get('delete/{id}', 'AdmController@onDelete');
});

Route::group(['middleware' => 'auth', 'prefix' => 'config'], function(){
    Route::get('', 'ConfigController@index');
    Route::post('update', 'ConfigController@onUpdate');
    Route::post('logo', 'ConfigController@upLogo');
});

Route::group(['middleware' => 'auth', 'prefix' => 'cat'], function(){
    Route::get('', 'CatController@index');
    Route::post('create', 'CatController@onCreate');
    Route::post('update', 'CatController@onUpdate');
    Route::post('search', 'CatController@search');
    Route::get('delete/{id}', 'CatController@onDelete');
});

Route::group(['middleware' => 'auth', 'prefix' => 'sub'], function(){
    Route::get('', 'SubController@index');
    Route::post('create', 'SubController@onCreate');
    Route::post('search', 'SubController@search');
    Route::post('update', 'SubController@onUpdate');
    Route::get('delete/{id}', 'SubController@onDelete');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
