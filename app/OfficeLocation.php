<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeLocation extends Model
{
    protected $table = 'office_locations';

    public function workingTime(){
        return $this->hasOne('\App\OfficeLocationWorkTime', 'location_id', 'id');
    }

    public function customWorkingTimes(){
        return $this->hasMany('App\OfficeLocationCustomWorkingTime', 'location_id', 'id');
    }
}
