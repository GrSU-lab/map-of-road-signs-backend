<?php

namespace App;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;
use App\LightPicture;

class Light extends Model
{
    public function pictures()
    {
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
