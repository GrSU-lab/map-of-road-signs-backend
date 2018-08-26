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

Route::get('/lights/delete/{light}','TrafficLightController@delete');
Route::get('/lights/create','TrafficLightController@create');
Route::post('/lights/post','TrafficLightController@store');

Route::get('lights/all','TrafficLightController@index');
Route::get('lights/{light}','TrafficLightController@show');

