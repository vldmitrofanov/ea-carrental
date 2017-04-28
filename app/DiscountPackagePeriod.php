<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DiscountPackagePeriod extends Model
{
    protected $table = 'discount_package_periods';

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
