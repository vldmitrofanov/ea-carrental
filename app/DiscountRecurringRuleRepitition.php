<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountRecurringRuleRepitition extends Model
{
    protected $table = 'discount_voucher_recurring_rule_repititions';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'start_repeat',
        'end_repeat',
    ];
}
