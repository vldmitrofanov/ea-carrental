<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DiscountRecurringRule extends Model
{
    protected $table = 'discount_voucher_recurring_rules';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'until_date',
    ];

    public function getUntilDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function repititions(){
        return $this->hasMany('\App\DiscountRecurringRuleRepitition', 'rule_id','id');
    }
}
