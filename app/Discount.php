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
        return $this->hasOne('\App\DiscountRecurringRule', 'voucher_id', 'id');
    }

    public function cars()
    {
        return $this->belongsToMany('App\RentalCar', 'discount_voucher_cars',
            'voucher_id', 'car_id'); //->withPivot('name', 'price', 'per', 'type')->wherePivot('status', 1);
    }
}
