<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RentalCar;
use App\Setting;

class FleetController extends Controller
{
    protected $option_arr = array();
    public function __construct()
    {
        $oSettings = Setting::get();
        foreach ($oSettings as $oSetting){
            $this->option_arr[$oSetting->key] = $oSetting->value;
        }
    }

    /**
     * Display a detail of the fleet car info.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($token)
    {
        $oCar = RentalCar::where('url_token', $token)->first();
        if(!$oCar){
            \Session::flash('flash_message', 'Car is not valid or has been removed.');
            \Session::flash('flash_type', 'alert-error');

            return \Redirect::to('/');
        }
        $currencySymbol = $this->getCurrencySign($this->option_arr['currency']);
        $currency = $this->option_arr['currency'];

        return view('frontend/fleet/detail/index', compact('oCar','currency', 'currencySymbol'));
    }

    public function getCurrencySign($currency)
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
