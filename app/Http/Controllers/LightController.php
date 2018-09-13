<?php

namespace App\Http\Controllers;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Light;
use App\LightPicture;

class LightController extends Controller
{
    public function index()
    {
        $lights = Light::all();
        return view('lights.index', compact('lights'));
    }
    public function addpic(Light $light)
    {
        $lightPic = new LightPicture;
        $lightPic->image_path=request('image_path');
        $lightPic->light_id =$light->id; // (lat, lng)
        $lightPic->save();
        //LightPicture::create([
        //    'light_id'=>$light->id,
        //    'image_path' => request('image_path')
        //]);

        return back();
    }

    public function show($id)
    {
        $light = Light::where('id',$id)->first();
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

}
