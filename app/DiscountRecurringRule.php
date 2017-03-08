<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountRecurringRule extends Model
{
    protected $table = 'discount_voucher_recurring_rules';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'until_date',
    ];
    
    public function repititions(){
        return $this->hasMany('\App\DiscountRecurringRuleRepitition', 'rule_id','id');
    }
}
