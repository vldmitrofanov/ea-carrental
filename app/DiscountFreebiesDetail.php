<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DiscountFreebiesDetail extends Model
{
    protected $table = 'discount_freebies_detail';
    
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
    
    public function car(){
        return $this->hasOne('\App\RentalCar', 'car_id', 'id');
    }
}
