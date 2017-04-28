<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CarModelPrice extends Model
{
    protected $table = 'car_model_prices';

    protected $dates = [
        'created_at',
        'updated_at',
        'date_from',
        'date_to'
    ];

    public function getDateFromAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function getDateToAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function carModel(){
        return $this->belongsTo('App\CarModel');
    }
}
