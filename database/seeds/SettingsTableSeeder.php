<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArr = [
                        'currency' => 'USD',
                        'mileage' => 'km',
                        'week_start' => 1,
                        'calculate_rental_fee' => 'both',
                        'minimum_booking_length' => '2',
                        'booking_pending' => '1',
                        'rental_terms' => 'Rental Terms and Conditions goes here',
                        'deposit_payment' => '2',
                        'deposit_type' => 'percent',
                        'tax_payment' => '2',
                        'tax_type' => 'percent',
                        'service_tax_payment' => '0',
                        'service_tax_type' => 'percent',
                        'security_payment' => '0',
                        'insurance_payment' => '0',
                        'insurance_type' => 'percent',
                        'booking_status' => 'pending',
                        'payment_disable' => '0',
                        'allow_cash' => '0',
                        'contact_us_notify' => 'Idrees:medriis@gmail.com',
                   ];


        foreach($dataArr as $key=>$value){
            $oSetting = Setting::where('key', $key)->first();
            if(!$oSetting){
                $oSetting = new Setting;
            }
            $oSetting->key = $key;
            $oSetting->value = $value;
            $oSetting->save();
        }
    }
}
