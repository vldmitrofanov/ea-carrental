<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DiscountFreebies extends Model
{
    protected $table = 'discount_freebies';

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
    ];

    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function details(){
        return $this->hasMany('App\DiscountFreebiesDetail', 'discount_freebies_id', 'id');
    }
    
    public function cars()
    {
        return $this->belongsToMany('App\RentalCar', 'discount_freebies_cars',
            'discount_freebies_id', 'car_id'); //->withPivot('name', 'price', 'per', 'type')->wherePivot('status', 1);
    }

    public function carModels()
    {
        return $this->belongsToMany('App\CarModel', 'discount_freebie_models',
            'discount_freebie_id', 'model_id'); //->withPivot('name', 'price', 'per', 'type')->wherePivot('status', 1);
    }

    public function periods(){
        return $this->hasMany('App\DiscountFreebiesPeriod', 'discount_freebies_id', 'id');
    }
}
