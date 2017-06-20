<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Setting;

class Booking
{
    public static function calculateDateDiff($start , $end){
        $from = Carbon::parse($start);
        $to = Carbon::parse($end);
        $datetime1 = new \DateTime($to); // Today's Date/Time
        $datetime2 = new \DateTime($from);
        $interval = $datetime1->diff($datetime2);
        $data['days'] = $interval->format('%D');
        $data['hours'] = $interval->format('%H');
        return $data['days']. ' Days and '.$data['hours'] .' Hours';
    }

    public static function formatTotal($price){
        $oSettings = Setting::where('key', 'currency')->first();
        return self::getCurrencySign($oSettings->value).$price;
    }

    public static function formatDiscountVolumne($price, $type){
        $oSettings = Setting::where('key', 'currency')->first();
        if($type=='percent'){
            return '-'. round($price).'%';
        }else {
            return '-'. round($price).self::getCurrencySign($oSettings->value) ;
        }
    }

    public static function getCurrencySign($currency)
    {
        switch ($currency)
        {
            case 'USD':
                $format = "$";
                break;
            case 'GBP':
                $format = "&pound;" ;
                break;
            case 'EUR':
                $format = "&euro;";
                break;
            case 'JPY':
                $format = "&yen;";
                break;
            case 'AUD':
            case 'CAD':
            case 'NZD':
            case 'CHF':
            case 'HKD':
            case 'SGD':
            case 'SEK':
            case 'DKK':
            case 'PLN':
                $format = $currency;
                break;
            case 'NOK':
            case 'HUF':
            case 'CZK':
            case 'ILS':
            case 'MXN':
                $format = $currency ;
                break;
            default:
                $format = $currency;
                break;
        }
        return $format;
    }
}