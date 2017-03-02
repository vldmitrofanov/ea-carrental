<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RentalCarReservation extends Model
{
    protected $table = 'rental_car_reservations';

    protected $dates = [
        'created_at',
        'updated_at',
        'date_from',
        'date_to',
        'pickup_date',
        'return_date'
    ];

    public function getDateFromAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');
    }

    public function getDateToAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');
    }

    public function getPickUpDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');
    }

    public function getReturnDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y h:i A');
    }

    public function user(){
        return $this->hasOne('\App\User', 'user_id', 'id');
    }
}