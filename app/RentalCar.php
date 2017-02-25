<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalCar extends Model
{
    protected $table = 'rental_cars';

    public function types()
    {
        return $this->belongsToMany('App\CarType', 'rental_car_types',
            'car_id', 'car_type_id');
    }
}
