<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RentalCarReservation;
use App\DiscountFreebies;
use App\RentalCar;
use App\CarReservationExtra;
use App\Setting;
use App\Http\Requests\SearchFormRequest;
use Session;
use Carbon\Carbon;
use App\CarModel;

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
        $oFeaturedCars = RentalCar::where('featured', true)->take(4)->get();
        return view('welcome', compact('oFeaturedCars'));
    }
    
    public function dashboard(){
        $currency = $this->option_arr['currency'];

        $oReservations = RentalCarReservation::where('user_id', \Auth::user()->id)->orderby('processed_on', 'DESC')->get();
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
        $oModels = $this->_getAvailableCars($searchData);

//print_r($oCars);exit;

        return view('frontend.search.index', compact('oModels', 'currency', 'searchData'));

    }

    private function _getAvailableCars($searchData){

        $date_from =Carbon::parse($searchData->start);
        $date_to =Carbon::parse($searchData->end);

        $date_from_ts = strtotime($date_from);
        $date_to_ts = strtotime($date_to);

//        $oCars = RentalCar::Join('car_reservation_details', 'rental_cars.id', '=', 'car_reservation_details.car_id')
//            ->Join('rental_car_reservations', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
//            ->where('rental_cars.status','=', true)
//            ->whereRaw("(`rental_car_reservations`.`status` != 'confirmed' OR (`rental_car_reservations`.`status` != 'pending'))")
//            ->whereRaw(sprintf("!(((`car_reservation_details`.`date_from` BETWEEN '%1\$s' AND '%2\$s') OR (`car_reservation_details`.`date_to` BETWEEN '%1\$s' AND '%2\$s')) OR (`car_reservation_details`.`date_from` < '%1\$s' AND `car_reservation_details`.`date_to` > '%2\$s') OR (`car_reservation_details`.`date_from` > '%1\$s' AND `car_reservation_details`.`date_to` < '%2\$s'))",$date_from, $date_to))
//            ->distinct()
//            ->paginate(10);

        $oModels = CarModel::Join('rental_cars', 'car_models.id', '=', 'rental_cars.model_id')
            ->Join('car_reservation_details', 'rental_cars.id', '=', 'car_reservation_details.car_id')
            ->Join('rental_car_reservations', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
            ->where('rental_cars.status','=', true)
            ->whereRaw("(`rental_car_reservations`.`status` != 'confirmed' OR (`rental_car_reservations`.`status` != 'pending'))")
            ->whereRaw(sprintf("!(((`car_reservation_details`.`date_from` BETWEEN '%1\$s' AND '%2\$s') OR (`car_reservation_details`.`date_to` BETWEEN '%1\$s' AND '%2\$s')) OR (`car_reservation_details`.`date_from` < '%1\$s' AND `car_reservation_details`.`date_to` > '%2\$s') OR (`car_reservation_details`.`date_from` > '%1\$s' AND `car_reservation_details`.`date_to` < '%2\$s'))",$date_from, $date_to))
            ->distinct('car_models.*')
            ->paginate(10);
//print_r($oCars);exit;
        return $oModels;
    }
}
