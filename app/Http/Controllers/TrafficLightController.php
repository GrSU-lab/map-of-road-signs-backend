<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrafficLight;

class TrafficLightController extends Controller
{
    public function show($id)
    {
        
        $light = TrafficLight::where('id',$id)->first();
        //dd($taskid);
        return view('trafficlights.show', compact('light'));
    }

    public function index()
    {
        $lights = TrafficLight::all();
        //dd($tasks);
        return view('trafficlights.index', compact('lights'));
    }

    public function create()
    {
        //$trafficlights = TrafficLight::all();
        //dd($tasks);
        return view('trafficlights.create');
    }


    function read_gps_location($file){
        if (is_file($file)) {
            $info = exif_read_data($file);
            if (isset($info['GPSLatitude']) && isset($info['GPSLongitude']) &&
                isset($info['GPSLatitudeRef']) && isset($info['GPSLongitudeRef']) &&
                in_array($info['GPSLatitudeRef'], array('E','W','N','S')) && in_array($info['GPSLongitudeRef'], array('E','W','N','S'))) {
    
                $GPSLatitudeRef  = strtolower(trim($info['GPSLatitudeRef']));
                $GPSLongitudeRef = strtolower(trim($info['GPSLongitudeRef']));
    
                echo var_dump($info['GPSLatitude'][2]);

                $lat_degrees_a = explode('/',$info['GPSLatitude'][0]);
                $lat_minutes_a = explode('/',$info['GPSLatitude'][1]);
                $lat_seconds_a = explode('/',$info['GPSLatitude'][2]);
                $lng_degrees_a = explode('/',$info['GPSLongitude'][0]);
                $lng_minutes_a = explode('/',$info['GPSLongitude'][1]);
                $lng_seconds_a = explode('/',$info['GPSLongitude'][2]);
                    
                $lat_degrees = $lat_degrees_a[0] / $lat_degrees_a[1];
                $lat_minutes = $lat_minutes_a[0] / $lat_minutes_a[1];
                $lat_seconds = $lat_seconds_a[0] / $lat_seconds_a[1];
                $lng_degrees = $lng_degrees_a[0] / $lng_degrees_a[1];
                $lng_minutes = $lng_minutes_a[0] / $lng_minutes_a[1];
                $lng_seconds = $lng_seconds_a[0] / $lng_seconds_a[1];
    
                $lat = (float) $lat_degrees+((($lat_minutes*60)+($lat_seconds))/3600);
                $lng = (float) $lng_degrees+((($lng_minutes*60)+($lng_seconds))/3600);
    
                //If the latitude is South, make it negative. 
                //If the longitude is west, make it negative
                $GPSLatitudeRef  == 's' ? $lat *= -1 : '';
                $GPSLongitudeRef == 'w' ? $lng *= -1 : '';
                return array(
                    'lat' => $lat,
                    'lng' => $lng
                );
            }          
        }
        return false;
    }

    public function delete($id)
    {
        TrafficLight::destroy($id);     
        return redirect('/');
    }

    public function store()
    {

        $this->validate(request(), [
            'input_img' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ]);

        $imageName = time().'.'.request()->input_img->getClientOriginalExtension();
        request()->input_img->move(public_path('trafficlights'), $imageName);   

        $photoPath = addslashes(public_path('trafficlights')."\\".$imageName);
        $point = $this->read_gps_location($photoPath);

        $light = new TrafficLight;

        $light->image_path="trafficlights\\".$imageName;
        $light->lat=$point['lat'];
        $light->long=$point['lng'];

        $light->save();

        return redirect('/')->with('success','Image Upload successfully');
    }
}
