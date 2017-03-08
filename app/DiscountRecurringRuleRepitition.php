<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DiscountRecurringRuleRepitition extends Model
{
    protected $table = 'discount_voucher_recurring_rule_repititions';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'start_repeat',
        'end_repeat',
    ];

    public function getStartRepeatAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y H:i');
    }

    public function getEndRepeatAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y H:i');
    }
}
