<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CarReservationDetail extends Model
{
    protected $table = 'car_reservation_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'date_from',
        'date_to',
        'pickup_date',
        'return_date'
    ];

    public function car(){
        return $this->hasOne('\App\RentalCar', 'id', 'car_id');
    }

    public function model(){
        return $this->hasOne('\App\CarModel', 'id', 'car_model_id');
    }

    public function carType(){
        return $this->hasOne('\App\Types', 'id', 'car_type_id');
    }

    public function getDateFromAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y H:i');
    }

    public function getDateToAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y H:i');
    }

    public function getPickUpDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y H:i');
    }

    public function getReturnDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y H:i');
    }
}
