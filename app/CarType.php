<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $table = 'car_types';

    public function getThumbPathAttribute($value)
    {
        if($value!=''){
            return  str_replace('public/', 'storage/', $value);
        }else{
            return 'administration/dist/img/no_img.png';
        }
    }

    public function prices(){
        return $this->hasMany('App\CarTypePrice', 'type_id', 'id');
    }

    public function extras()
    {
        return $this->belongsToMany('App\CarExtra', 'car_type_extras',
            'car_type_id', 'car_extras_id');
    }

    public function cars()
    {
        return $this->belongsToMany('App\RentalCar', 'rental_car_types',
            'car_type_id','car_id');
    }
}
