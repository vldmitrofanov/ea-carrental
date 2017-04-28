<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DiscountFreebiesPeriod extends Model
{
    protected $table = 'discount_freebie_periods';

    protected $dates = [
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
}
