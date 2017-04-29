<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Setting;
use Session;
use Carbon\Carbon;

class RentalCar extends Model
{
    protected $table = 'rental_cars';

    public function types()
    {
        return $this->belongsToMany('App\CarType', 'rental_car_types',
            'car_id', 'car_type_id');
    }

    public function makeAndModel(){
        return $this->hasOne('\App\CarModel', 'id', 'model_id');
    }


    public function location(){
        return $this->hasOne('\App\OfficeLocation', 'id', 'location_id');
    }

    public function getThumbImageAttribute($value)
    {
        if($value!=''){
            return  str_replace('public/', 'storage/', $value);
        }else{
            return 'administration/dist/img/no_img.png';
        }
    }
    
    private function _calculateDateDiff($start , $end){
        $from = Carbon::parse($start);
        $to = Carbon::parse($end);
        $datetime1 = new \DateTime($to); // Today's Date/Time
        $datetime2 = new \DateTime($from);
        $interval = $datetime1->diff($datetime2);
        $data['days'] = $interval->format('%D');
        $data['hours'] = $interval->format('%H');
        return $data;
    }
    
    public function getCarPrice(){        
        $cartData = Session::get('oCart');
        
        $o_new_day_per_day =0 ;
        $oSetting = Setting::where('key', 'currency')->first();
        $currency = ($oSetting)?$oSetting->value:'USD';

        $time = $this->_calculateDateDiff($cartData->date_from, $cartData->date_to);

        $oRentalCar = $this;
        print_r($oRentalCar);exit;
        
        $oCarType = Types::where('id',$request->input('car_type_id'))->first();
        if(!$oCarType){
            return $this->_failedJsonResponse([['Car Type is not valid or has been removed.']]);
        }

        $oCarModel = CarModel::where('id',$request->input('models'))->first();
        if(!$oCarModel){
            return $this->_failedJsonResponse([['Car Model is not valid or has been removed.']]);
        }

        
    }
    
}
