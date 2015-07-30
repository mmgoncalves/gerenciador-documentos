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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'arq'], function(){
    Route::get('', 'ArquivoController@index');
    Route::get('create', 'ArquivoController@create');
});

Route::group(['prefix' => 'adm'], function(){
    Route::get('find/{id}', 'AdmController@find');
    Route::get('listAll', 'AdmController@listAll');
    Route::post('search', 'AdmController@search');
    Route::post('update', 'AdmController@onUpdate');
    Route::post('create', 'AdmController@onCreate');
    Route::get('delete/{id}', 'AdmController@onDelete');
});

Route::group(['prefix' => 'config'], function(){
    Route::get('', 'ConfigController@index');
    Route::post('update', 'ConfigController@onUpdate');
    Route::post('logo', 'ConfigController@upLogo');
});

Route::group(['prefix' => 'cat'], function(){
    Route::get('', 'CatController@index');
});