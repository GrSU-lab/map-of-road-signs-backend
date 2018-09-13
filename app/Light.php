<?php

namespace App;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;
use App\LightPicture;

class Light extends Model
{
    public function pictures()
    {
<<<<<<< HEAD
=======

>>>>>>> cdf68d877da7d4f282c0174762ff0756286a4dc7
        return $this->hasMany(LightPicture::class);
    }
    use SpatialTrait;

    protected $fillable = [
        'name'
    ];

    protected $spatialFields = [
        'location'
    ];
}
