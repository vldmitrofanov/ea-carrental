<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalCarReservationExtra extends Model
{
    protected $table = 'rental_car_reservation_extras';

    public function extra(){
        return $this->hasOne('\App\CarExtra', 'id', 'extra_id');
    }
}
