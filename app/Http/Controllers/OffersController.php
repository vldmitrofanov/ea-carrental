<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use App\Setting;
use App\DiscountVolume;
use App\RentalCar;

class OffersController extends Controller
{
    protected $option_arr = array();
    public function __construct()
    {
        $oSettings = Setting::get();
        foreach ($oSettings as $oSetting){
            $this->option_arr[$oSetting->key] = $oSetting->value;
        }
    }

    public function index($token){
        $tokenArr = explode("-", $token);
        $volumeDiscountId =  end($tokenArr);

        if((int)$volumeDiscountId==0){
            \Session::flash('flash_message', 'Offer url is not valid.');
            \Session::flash('flash_type', 'alert-danger');

            return \Redirect::to('/');
        }

        $oDiscountVolume = DiscountVolume::whereIn('id', function($query){
                                $query->select('discount_package_id')->from('discount_package_periods')
                                    ->distinct()
                                    ->whereRaw(" DATE_FORMAT(start_date, \"%Y-%m-%d\") <= CURDATE() and DATE_FORMAT(end_date, \"%Y-%m-%d\")>=CURDATE() ");
                            })
                            ->where('id',$volumeDiscountId)
                            ->where('status',true)
                            ->first();
        if(!$oDiscountVolume){
            \Session::flash('flash_message', 'Offer does exist any more.');
            \Session::flash('flash_type', 'alert-danger');

            return \Redirect::to('/');
        }

        $oPeriod = $oDiscountVolume->periods()->whereRaw(" start_date <= NOW() and end_date>=NOW() ")->first();
        $search = new \stdClass();
        Session::forget('offers');

        $search->start = Carbon::now()->format('Y-m-d'); //Carbon::parse($oPeriod->start_date);

        switch ($oDiscountVolume->booking_duration_type){
            case"days":
                $search->end = Carbon::parse($oPeriod->start)->addDays($oDiscountVolume->booking_duration)->format('Y-m-d');
                break;
            case"weeks":
                $search->end = Carbon::parse($oPeriod->start)->addWeeks($oDiscountVolume->booking_duration)->format('Y-m-d');
                break;
            case"month":
                $search->end = Carbon::parse($oPeriod->start)->addMonths($oDiscountVolume->booking_duration)->format('Y-m-d');
                break;

        }

        $timeDiff = $this->_calculateDateDiff( $search->start, $search->end);
        $search->days = $timeDiff['days'];
        $search->hours = $timeDiff['hours'];

        Session::put('offers', $search);
        $offersData = Session::get('offers');

        $currency = $this->option_arr['currency'];
        $oCars = $this->_getAvailableCars($offersData, $oDiscountVolume);

        return view('frontend.offers_fleet.index', compact('oCars', 'currency', 'oDiscountVolume', 'search'));

    }

    private function _getAvailableCars($searchData, $oDiscountVolume){
        $date_from =Carbon::parse($searchData->start);
        $date_to = Carbon::parse($searchData->end);

        $date_from_ts = strtotime($date_from);
        $date_to_ts = strtotime($date_to);
        $oCars = RentalCar::whereNotIn('id', function($query) use ($date_from, $date_to){
                    $query->select('car_id')
                        ->from('car_reservation_details')
                        ->Join('rental_car_reservations', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
                        ->whereRaw("(`rental_car_reservations`.`status` = 'confirmed' OR `rental_car_reservations`.`status` = 'collected'  OR (`rental_car_reservations`.`status` = 'pending'))")
                        ->whereRaw(sprintf("(((`car_reservation_details`.`date_from` BETWEEN '%1\$s' AND '%2\$s') OR (`car_reservation_details`.`date_to` BETWEEN '%1\$s' AND '%2\$s')) OR (`car_reservation_details`.`date_from` < '%1\$s' AND `car_reservation_details`.`date_to` > '%2\$s') OR (`car_reservation_details`.`date_from` > '%1\$s' AND `car_reservation_details`.`date_to` < '%2\$s'))",$date_from, $date_to));
                })
                ->whereIn('model_id',$oDiscountVolume->carModels()->pluck('id')->toArray())
                ->where('rental_cars.status','=', true)
                ->paginate(10);
        return $oCars;
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

    public function rentalOffers(){
        $oDiscountVolumes = DiscountVolume::whereIn('id', function($query){
                                $query->select('discount_package_id')->from('discount_package_periods')
                                    ->distinct()
                                ->whereRaw(" start_date <= NOW() and end_date>=NOW() ");
                            })
                            ->where('status',true)
                            ->paginate(12);

        return view('frontend.rental_offers.index', compact('oDiscountVolumes'));
    }

}
