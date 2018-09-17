<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Photo extends Model
{
    use SpatialTrait;

    protected $fillable = [
        'name'
    ];

    protected $spatialFields = [
        'coordinates'
    ];

    public function expose() {
        return get_object_vars($this);
    }

    //protected $geometry = ['coordinates'];
}
