<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarReservation extends Model
{
    protected $table = 'rental_car_reservations';

    protected $dates = [
        'created_at',
        'updated_at',
        'date_from',
        'date_to',
        'pickup_date',
        'return_date',
        'processed_on',
    ];

    public function details(){
        return $this->hasMany('App\CarReservationDetail', 'reservation_id', 'id');
    }

    public function payments(){
        return $this->hasMany('App\CarReservationPayment', 'reservation_id', 'id');
    }

    public function extras(){
        return $this->hasMany('App\CarReservationExtra', 'reservation_id', 'id');
    }
   
    public function getProcessedOnAttribute($value)
    {
        return Carbon::parse($value)->format('F jS, Y');
    }
    
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
