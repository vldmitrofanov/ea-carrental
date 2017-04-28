<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CarModel extends Model
{
    protected $table = 'car_models';

    public function getThumbPathAttribute($value)
    {
        if($value!=''){
            return  str_replace('public/', 'storage/', $value);
        }else{
            return 'administration/dist/img/no_img.png';
        }
    }

    public function prices(){
        return $this->hasMany('App\CarModelPrice', 'model_id', 'id');
    }

    public function extras()
    {
        return $this->belongsToMany('App\CarExtra', 'car_model_extras',
            'car_model_id', 'car_extras_id'); //->withPivot('name', 'price', 'per', 'type')->wherePivot('status', 1);
    }

    public function cars()
    {
        return $this->belongsToMany('App\RentalCar', 'rental_car_types',
            'car_type_id','car_id');
    }

    public function SIPPCode(){
        return $this->hasOne('\App\Types', 'id', 'type_id');
    }
}
