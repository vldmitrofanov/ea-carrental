<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OfficeLocationCustomWorkingTime extends Model
{
    protected $table = 'office_location_custom_working_times';

    protected $dates = [
        'created_at',
        'updated_at',
        'work_date'
    ];

    public function getWorkDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function getStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }

//    public function getIsDayOffAttribute($value)
//    {
//        if($value){
//            return 'Yes';
//        }else{
//            return 'No';
//        }
//    }


}
