<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Photo;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{
    public function index()
    {
        $dir = public_path('\\files\\lights\\');
        $images = scandir($dir); 
        $arr=[];
        $sum=[];
        foreach ($images as $image)
        {   
            if (!($image=="."||$image==".."||$image=="ico"))
            {
                $sum = $image;
                $coord=$this->read_gps(public_path('\\files\\lights\\').$image);
                $img=['images' => [public_path('\\files\\lights\\').$image], 'images_ico' => [public_path('\\files\\lights\\ico\\').$image], 'location' => [ $coord['lat'], $coord['lon']]];
                array_push($arr, $img);
            }
        }  
        $photos=json_encode($arr);
        return view('photos.index', compact('photos')); 
    }

    public function index_one($name)
    {
        $img=['name' => public_path('\\files\\lights\\').$name, 'name_ico' => public_path('\\files\\lights\\ico\\').$name, 'location' => $this->read_gps(public_path('\\files\\lights\\').$name)];
        $photo=json_encode($img);
        return view('photos.index_one', compact('photo'));
    }

    public function create()
    {
        return view('photos.upload');
    }

    public function createIcon($image_path, $image_name)
    {
        $img_resize = Image::make($image_path);
        $img_resize->resize(50, 50);
        $img_resize->save(public_path('files/icons/ico' .$image_name));
    }

    public function show($id)
    {
        $photo = Photo::where('id',$id)->first();
        return view('photos.show', compact('photo'));
    }

    public function delete($name)
    {
        unlink(public_path('\\files\\lights\\').$name);
        unlink(public_path('\\files\\lights\\ico\\').$name);
        return redirect('/');
    }

    public function store()
    {
        $imageName = time().'.'.request()->input_img->getClientOriginalExtension();
        request()->input_img->move(public_path('files'), $imageName);
        $photoPath = addslashes(public_path('files')."\\".$imageName);

        $photo = new Photo;
        $photo->image_url=$photoPath;
        $point = $this->read_gps($photoPath);
        $this->createIcon($photoPath, $imageName);
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
