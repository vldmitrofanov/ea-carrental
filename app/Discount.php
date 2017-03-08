<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount_vouchers';

    protected $dates = [
        'created_at',
        'updated_at',
        'processed_on',
    ];
    
    public function recurring(){
        return $this->hasOne('\App\DiscountRecurringRule', 'id', 'voucher_id');
    }
}
