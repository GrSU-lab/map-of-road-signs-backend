<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class TrafficLight extends Model
{
    use SpatialTrait;

    protected $fillable = [
        'name'
    ];

    protected $spatialFields = [
        'location'
    ];
}
