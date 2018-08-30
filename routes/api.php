<?php

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

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

Route::get('/photo/delete/{photo}','PhotoController@delete');
Route::get('/photo/create','PhotoController@create');
Route::post('/photo/post','PhotoController@store');

Route::get('photo/all','PhotoController@index');
Route::get('photo/{photo}','PhotoController@show');


