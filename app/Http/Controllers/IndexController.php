<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarReservation as RentalCarReservation;
use App\DiscountFreebies;
use App\RentalCar;
use App\CarReservationExtra;
use App\Setting;
use App\Http\Requests\SearchFormRequest;
use Session;
use Carbon\Carbon;
use App\CarModel;
use App\DiscountVolume;
use App\OfficeLocation;

class IndexController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oDiscountVolumes = DiscountVolume::whereIn('id', function($query){
                                $query->select('discount_package_id')->from('discount_package_periods')
                                ->distinct()
                                ->whereRaw(" DATE_FORMAT(start_date, \"%Y-%m-%d\") <= CURDATE() and DATE_FORMAT(end_date, \"%Y-%m-%d\")>=CURDATE() ");
                            })
                            ->where('featured', true)
                            ->where('status',true)
                            ->take(3)
                            ->get();

        $oFeaturedCars = RentalCar::where('featured', true)->take(4)->get();
        return view('welcome', compact('oFeaturedCars','oDiscountVolumes'));
    }
    
    public function dashboard(){
        $currency = $this->option_arr['currency'];

        $oReservations = RentalCarReservation::
                            where('user_id', \Auth::user()->id)->orderby('processed_on', 'DESC')->get();
        return view('frontend.dashboard.index', compact('oReservations', 'currency'));
    }

    public function calculateDateDiff($start , $end){
        $from = Carbon::parse($start);
        $to = Carbon::parse($end);
        $datetime1 = new \DateTime($to); // Today's Date/Time
        $datetime2 = new \DateTime($from);
        $interval = $datetime1->diff($datetime2);
        $data['days'] = $interval->format('%D');
        $data['hours'] = $interval->format('%H');
        return $data;
    }


    public function search(SearchFormRequest $request){
        $searchData = Session::get('search');
        if(empty($searchData) && \Request::isMethod('get')){
            return \Redirect::to('/');
        }
        if(\Request::isMethod('post')) {
            $search = new \stdClass();
            Session::forget('search');

            $search->start = $request->get('start');
            $search->end = $request->get('end');
            $search->location = $request->get('location');

            $timeDiff = $this->calculateDateDiff($request->get('start'), $request->get('end'));
            $search->days = $timeDiff['days'];
            $search->hours = $timeDiff['hours'];

            Session::put('search', $search);
            $searchData = Session::get('search');
        }

        $currency = $this->option_arr['currency'];
        $oCars = $this->_getAvailableCars($searchData);

        return view('frontend.search.index', compact('oCars', 'currency', 'searchData'));

    }

    public function ourFleet($country='', $city=''){
        $searchData = Session::get('search');
        //if(empty($searchData)){
            $oOfficeLocation = false;
            $search = new \stdClass();
            Session::forget('search');
            if($city!='' && $country!=''){
                $oOfficeLocation = OfficeLocation::where('city', 'like', '%'.str_replace("-", " ", $city).'%')
                                   ->whereIn('country_id', function($query) use ($country){
                                        $query->select('id')->from('countries')
                                        ->where('name', 'like', '%'.str_replace("-", " ", $country).'%');
                                    })
                                   ->first();
            }
            $search->start = Carbon::now();
            $search->end = Carbon::now()->addHours(24);
            $search->location = ($oOfficeLocation)?$oOfficeLocation->id:0;

            $timeDiff = $this->calculateDateDiff( Carbon::now(), Carbon::now()->addHours(24));
            $search->days = $timeDiff['days'];
            $search->hours = $timeDiff['hours'];

            Session::put('search', $search);
            $searchData = Session::get('search');
       // }

        $currency = $this->option_arr['currency'];
        $oCars = $this->_getAvailableCars($searchData);

        return view('frontend.our_fleet.index', compact('oCars', 'currency', 'searchData'));

    }

    private function _getAvailableCars($searchData){

        $date_from =Carbon::parse($searchData->start);
        $date_to =Carbon::parse($searchData->end);        
        $date_from_ts = strtotime($date_from);
        $date_to_ts = strtotime($date_to);
        
        if($searchData->location==0){
            $where = "rental_cars.location_id > $searchData->location ";
        }else{
            $where = "rental_cars.location_id = $searchData->location ";
        }
        $oCars = RentalCar::whereNotIn('id', function($query) use ($date_from, $date_to){
                        $query->select('car_id')->from('car_reservation_details')
//                        ->whereRaw("(`rental_car_reservations`.`status` = 'cancelled' OR (`rental_car_reservations`.`status` = 'completed'))")
                        ->whereRaw(sprintf("(((`car_reservation_details`.`date_from` BETWEEN '%1\$s' AND '%2\$s') OR (`car_reservation_details`.`date_to` BETWEEN '%1\$s' AND '%2\$s')) OR (`car_reservation_details`.`date_from` < '%1\$s' AND `car_reservation_details`.`date_to` > '%2\$s') OR (`car_reservation_details`.`date_from` > '%1\$s' AND `car_reservation_details`.`date_to` < '%2\$s'))",$date_from, $date_to));
                 })
                 ->where('rental_cars.status','=', true)
                 ->whereRaw($where)
                ->paginate(10);
       
//        $oCars = RentalCar::leftJoin('car_reservation_details', 'rental_cars.id', '=', 'car_reservation_details.car_id')
//            ->leftJoin('rental_car_reservations', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
//            ->where('rental_cars.status','=', true)
////            ->whereRaw("(`rental_car_reservations`.`status` = 'cancelled' OR (`rental_car_reservations`.`status` = 'completed'))")
//            ->whereRaw(sprintf("!(((`car_reservation_details`.`date_from` BETWEEN '%1\$s' AND '%2\$s') OR (`car_reservation_details`.`date_to` BETWEEN '%1\$s' AND '%2\$s')) OR (`car_reservation_details`.`date_from` < '%1\$s' AND `car_reservation_details`.`date_to` > '%2\$s') OR (`car_reservation_details`.`date_from` > '%1\$s' AND `car_reservation_details`.`date_to` < '%2\$s'))",$date_from, $date_to))
////
////            ->with([
////                'makeAndModel'
////            ])
////            ->select('rental_cars.*')
////            ->groupBy('rental_cars.id')
//            ->distinct()
//            ->paginate();
//            ->toSql();
//            ->get(['rental_cars.id']);
//        dd($oCars->count());
//        exit;

//        $oModels = CarModel::Join('rental_cars', 'car_models.id', '=', 'rental_cars.model_id')
//            ->Join('car_reservation_details', 'rental_cars.id', '=', 'car_reservation_details.car_id')
//            ->Join('rental_car_reservations', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
//            ->where('rental_cars.status','=', true)
//            ->whereRaw("(`rental_car_reservations`.`status` != 'confirmed' OR (`rental_car_reservations`.`status` != 'pending'))")
//            ->whereRaw(sprintf("!(((`car_reservation_details`.`date_from` BETWEEN '%1\$s' AND '%2\$s') OR (`car_reservation_details`.`date_to` BETWEEN '%1\$s' AND '%2\$s')) OR (`car_reservation_details`.`date_from` < '%1\$s' AND `car_reservation_details`.`date_to` > '%2\$s') OR (`car_reservation_details`.`date_from` > '%1\$s' AND `car_reservation_details`.`date_to` < '%2\$s'))",$date_from, $date_to))
//            ->distinct('car_models.*')
//            ->paginate(10);
//print_r($oCars);exit;
        return $oCars;
    }
}
