<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LightPicture extends Model
{
    public function light()
    {
        return $this->belongsTo(Light::class);
    }
}
