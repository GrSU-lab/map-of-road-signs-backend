<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LightPicture;

class Light extends Model
{
    public function pictures()
    {
        
        return $this->hasMany(LightPicture::class);
    }
    public function addPic($image_path)
    {
        //$this->pictures()->create(['image_path'=>$image_path]);
        LightPicture::create([
            'image_path'=>$image_path,
            'light_id'=>$this->id
        ]);
    }
}
