<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Photo extends Model
{
    protected $geometry = ['coordinates'];

    public function getCoordinatesAttribute($value)
    {
        $string = str_replace(['POINT(', ' ', ')'], ['', ',', ''], $value);
        return explode(',', $string);
    }

    public function newQuery($excludeDeleted = true)
    {
        if (!empty($this->geometry)) {
            $raw = '';

            foreach ($this->geometry as $column) {
                $raw .= 'AsText(`' . $this->table . '`.`' . $column . '`) as `' . $column  . '`, ';
            }
            $raw = substr($raw, 0, -2);

            return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
        }

        return parent::newQuery($excludeDeleted);
    }
}
