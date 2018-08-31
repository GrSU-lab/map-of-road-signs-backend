<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Light;
use App\LightPicture;

class LightController extends Controller
{
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

        //$lightpath = DB::table('lights')
        //->join('light_pictures', 'lights.id', '=', 'light_pictures.light_id')
        //->select('light_pictures.id','light_pictures.image_path')
        //->get();
//
        //$light = DB::table('lights')
        //->select('lights.id','lights.location')
        //->where('lights.id','=',$id)
        //->get();
//
        //$lightpath = $lightpath->all();
        //$lightpath = $lightpath[0];
        //$lightpath = $lightpath;


        //$light[0]["Photos"]="blsvjsld";
        //$light -> pictures;
        //dd($light);
        //return view('lights.show', compact('light'));
    }

}
