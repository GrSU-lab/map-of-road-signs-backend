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

Route::get('photo', 'PhotoController@index');

Route::get('/GPS', function () {
    $exif = exif_read_data(storage_path('app/public/' . 'check.jpg'), 'GPS');
    $lon = getGps($exif['GPSLongitude'], $exif['GPSLongitudeRef']);
    $lat = getGps($exif['GPSLatitude'], $exif['GPSLatitudeRef']);
    $info = $lon.' , '.$lat;
    return view('upload', ['coordinates' => $info ]);
});


function getGps($exifCoord, $hemi) {
    $degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
    $minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
    $seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;
    $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;
    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);
}

function gps2Num($coordPart) {
    $parts = explode('/', $coordPart);
    if (count($parts) <= 0)
        return 0;
    if (count($parts) == 1)
        return $parts[0];
    return floatval($parts[0]) / floatval($parts[1]);
}