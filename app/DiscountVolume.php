<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DiscountVolume extends Model
{
    protected $table = 'discount_packages';

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

    public function cars()
    {
        return $this->belongsToMany('App\RentalCar', 'discount_package_cars',
            'discount_package_id', 'car_id'); //->withPivot('name', 'price', 'per', 'type')->wherePivot('status', 1);
    }
}
