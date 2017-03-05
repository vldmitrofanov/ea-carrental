<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarExtra extends Model
{
    protected $table = 'car_extras';

    public function carType()
    {
        return $this->belongsTo('App\CarType');
    }
}
