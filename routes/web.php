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

//Route::post('/lights/pictures/{lightpicture}','LightController@deletepic');
Route::get('/lights/show/all','LightController@index');
Route::get('/lights/create','LightController@create');
Route::post('/lights/post','LightController@store');
Route::get('/lights/show/{light}','LightController@show');
Route::post('/lights/{light}/pictures','LightController@addpic');
Route::get('/lights/delete/{light}','LightController@dellight');
Route::get('/lights/pictures/delete/{lightpicture}','LightController@delpic');




