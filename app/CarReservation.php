<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarReservation extends Model
{
    protected $table = 'rental_car_reservations';

    protected $dates = [
        'created_at',
        'updated_at',
        'processed_on',
    ];

    public function user(){
        return $this->hasOne('\App\User', 'id', 'user_id');
    }

    public function details(){
        return $this->hasMany('App\CarReservationDetail', 'reservation_id', 'id');
    }

    public function payments(){
        return $this->hasMany('App\CarReservationPayment', 'reservation_id', 'id');
    }

    public function extras(){
        return $this->hasMany('App\CarReservationExtra', 'reservation_id', 'id');
    }

}
