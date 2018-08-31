<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Photo;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    public function index()
    {
        //$photo = new Photo;
        //$photo->image_url="/photo";
        //$photo->coordinates = new Point(40.74894149554006, -73.98615270853043);
       // $photo->save();
        return Photo::all();
    }

    public function create()
    {
        return view('photos.upload');
    }

    public function show($id)
    {
        $photo = Photo::where('id',$id)->first();
        return view('photos.show', compact('photo'));
    }

    public function delete($id)
    {
        Photo::destroy($id);
        return redirect('/');
    }

    public function store()
    {;
        echo 'kek';
        $imageName = time().'.'.request()->input_img->getClientOriginalExtension();
        request()->input_img->move(storage_path('app/public'), $imageName);
        echo storage_path('app/public'), $imageName;
        $photoPath = addslashes(storage_path('app/public')."\\".$imageName);
        echo $photoPath;
        $point = $this->read_gps($photoPath);

        $photo = new Photo;

        $photo->image_url=$photoPath;
        $photo->coordinates = new Point($point['lat'],$point['lon']);
        $photo->save();

        return redirect('/')->with('success','Image Upload successfully');
    }

    function getGps($exifCoord, $hemi)
    {
        $pc = new PhotoController;
        $degrees = count($exifCoord) > 0 ? $this->gps2Num($exifCoord[0]) : 0;
        $minutes = count($exifCoord) > 1 ? $this->gps2Num($exifCoord[1]) : 0;
        $seconds = count($exifCoord) > 2 ? $this->gps2Num($exifCoord[2]) : 0;
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

    function read_gps($file)
    {
        if (is_file($file)) {
            $exif = exif_read_data($file);;
            $lon = $this->getGps($exif['GPSLongitude'], $exif['GPSLongitudeRef']);
            $lat = $this->getGps($exif['GPSLatitude'], $exif['GPSLatitudeRef']);
            return array(
                'lat' => $lat,
                'lon' => $lon
            );
        }
        return false;
    }
}
