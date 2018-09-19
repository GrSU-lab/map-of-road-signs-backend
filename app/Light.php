<?php

namespace App;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;
use App\LightPicture;

class Light extends Model
{
    public function images()
    {
        return $this->hasMany(LightPicture::class);
    }
    public function lightdelete()
    {
        // delete all related photos 
        $this->images()->delete();
        
        return parent::delete();
    }
    use SpatialTrait;

    protected $fillable = [
        'name'
    ];

    protected $spatialFields = [
        'location'
    ];
}
