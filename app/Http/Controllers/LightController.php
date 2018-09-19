<?php

namespace App\Http\Controllers;

use App\Light;
use App\LightPicture;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;

class LightController extends Controller
{
    public function index()
    {
        //dd("sadas");
        $lights = Light::all();
        foreach($lights as $light)
        {
            $light['location']=[$light['location']->getLat(), $light['location']->getLng()];
        }
        return view('lights.index', compact('lights'));
    }
    public function addpic(Light $light)
    {
        $lightPic = new LightPicture;
        $lightPic->image_path = request('image_path');
        $lightPic->light_id = $light->id; // (lat, lng)
        $lightPic->save();
        //LightPicture::create([
        //    'light_id'=>$light->id,
        //    'image_path' => request('image_path')
        //]);

        return back();
    }
    public function delpic($id)
    {
        LightPicture::destroy($id);
        return back();
    }

    public function dellight($id)
    {
        Light::where('id', $id)->first()->lightdelete();
        return back();
    }

    public function show($id)
    {
        $light = Light::where('id', $id)->first();
        $someVar = $light->images;
        $light['images'] = $someVar->toArray();
        //dd($someVar->toArray());
        return view('lights.show', compact('light'));
    }

    public function create()
    {
        return view('lights.create');
    }

    public function store()
    {
        $light = new Light;
        $light->location = new Point(40.7484404, -73.9878441); // (lat, lng)
        $light->save();
        return back();
    }

    public function createicon($cmd, $args, $elfinder, $volume)
    {
        $ImageName = $args['added']['0']['name'];

        $path = public_path('files\lights\\'.$ImageName);

        // файл
        $filename = $path;

        // задание максимальной ширины и высоты
        $width = 200;
        $height = 200;

        // тип содержимого
        header('Content-Type: image/jpeg');

        // получение новых размеров
        list($width_orig, $height_orig) = getimagesize($filename);

        $ratio_orig = $width_orig / $height_orig;

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        // ресэмплирование
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        // вывод
        imagejpeg($image_p,public_path('files\lights\ico\\'.$ImageName), 100);

        return true;
    }

}
