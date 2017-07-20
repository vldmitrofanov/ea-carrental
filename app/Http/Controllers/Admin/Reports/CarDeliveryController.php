<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\RentalCarReservation;
use App\CarReservation;

class CarDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        return view('admin.reports.deliveries');
    }
    
    public function report(Request $request){
        $this->_checkAjaxRequest();
        
        $tableColumns = ['', 'users.name', 'car_models.make', 'rental_cars.registration_number', '', '', 'rental_car_reservations.status', 'car_reservation_details.total_price',''];
        $orderBy = $request->input('order')[0]['dir']; //asc or desc

        $searchStr = $request->input('search')['value'];
        $start = ($request->input('start')) ?: 0;
        $end = ($request->input('length')) ? $request->input('length') : 10;
        $start_date = ($request->input('start_date')!='') ? Carbon::parse($request->input('start_date'))->format('Y-m-d') : date('Y-m-d');
        $end_date = ($request->input('end_date')!='') ? Carbon::parse($request->input('end_date'))->format('Y-m-d') : date('Y-m-d');
        
        if(trim($searchStr)!=''){
            $total = CarReservation::
                Join('users', 'rental_car_reservations.user_id', '=', 'users.id')
                ->Join('car_reservation_details', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
                ->Join('rental_cars', 'car_reservation_details.car_id', '=', 'rental_cars.id')
                ->Join('car_models', 'car_reservation_details.car_model_id', '=','car_models.id')
                ->whereRaw("( users.name like '%$searchStr%' or car_models.make like '%$searchStr%' 
                              or car_models.model like '%$searchStr%' 
                              or rental_cars.registration_number like '%$searchStr%' 
                              or rental_car_reservations.status like '%$searchStr%' 
                          )")
                ->whereRaw('DATE_FORMAT(`car_reservation_details`.`date_from`, "%Y-%m-%d") between  "'.$start_date.'"  AND  "'.$end_date.'" ')
                ->orderBy('rental_car_reservations.id')
                ->orderBy($tableColumns[$request->input('order')[0]['column']], $orderBy)
                ->with([
                    'details',

                ])
                ->distinct('rental_car_reservations.id')
                ->count('rental_car_reservations.id');

            $oOrders = CarReservation::
                Join('users', 'rental_car_reservations.user_id', '=', 'users.id')
                ->Join('car_reservation_details', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
                ->Join('rental_cars', 'car_reservation_details.car_id', '=', 'rental_cars.id')
                ->Join('car_models', 'car_reservation_details.car_model_id', '=','car_models.id')
                ->whereRaw("( users.name like '%$searchStr%' or car_models.make like '%$searchStr%' 
                              or car_models.model like '%$searchStr%' 
                              or rental_cars.registration_number like '%$searchStr%' 
                              or rental_car_reservations.status like '%$searchStr%'  
                            )")
                ->whereRaw('DATE_FORMAT(`car_reservation_details`.`date_from`, "%Y-%m-%d") between  "'.$start_date.'"  AND  "'.$end_date.'" ')
                ->orderBy('rental_car_reservations.id')
                ->orderBy($tableColumns[$request->input('order')[0]['column']], $orderBy)
                ->skip($start)->take($end)
                ->with([
                    'user','details','details.car','details.model','details.carType','details.carType.vehicleSize'
                    ,'details.carType.vehicleDoors','details.carType.vehicleTransmissionAndDrive','details.carType.vehicleFuelAndAC'

                ])->distinct()
                ->get([
                    'rental_car_reservations.*','users.name','car_models.make','rental_cars.registration_number'
                    ,'car_reservation_details.total_price','rental_car_reservations.status'
                ]);
        }else{
            $total = CarReservation::
                Join('users', 'rental_car_reservations.user_id', '=', 'users.id')
                ->Join('car_reservation_details', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
                ->Join('rental_cars', 'car_reservation_details.car_id', '=', 'rental_cars.id')
                ->Join('car_models', 'car_reservation_details.car_model_id', '=','car_models.id')
                ->whereRaw('DATE_FORMAT(`car_reservation_details`.`date_from`, "%Y-%m-%d") between  "'.$start_date.'"  AND  "'.$end_date.'" ')
                ->orderBy('rental_car_reservations.id')
                ->orderBy($tableColumns[$request->input('order')[0]['column']], $orderBy)
                ->with([
                    'details',

                ])
                ->distinct('rental_car_reservations.id')
                ->count('rental_car_reservations.id');

            $oOrders = CarReservation::
                    Join('users', 'rental_car_reservations.user_id', '=', 'users.id')
                    ->Join('car_reservation_details', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
                    ->Join('rental_cars', 'car_reservation_details.car_id', '=', 'rental_cars.id')
                    ->Join('car_models', 'car_reservation_details.car_model_id', '=','car_models.id')
                    ->whereRaw('DATE_FORMAT(`car_reservation_details`.`date_from`, "%Y-%m-%d") between  "'.$start_date.'"  AND  "'.$end_date.'" ')
                    ->orderBy('rental_car_reservations.id')
                    ->orderBy($tableColumns[$request->input('order')[0]['column']], $orderBy)
                    ->with([
                        'user','details','details.car','details.model','details.carType','details.carType.vehicleSize'
                        ,'details.carType.vehicleDoors','details.carType.vehicleTransmissionAndDrive','details.carType.vehicleFuelAndAC'

                    ])->distinct()
                    ->get([
                        'rental_car_reservations.*','users.name','car_models.make','rental_cars.registration_number'
                        ,'car_reservation_details.total_price','rental_car_reservations.status'
                    ]);
        }
        
        $data = ['total'=>$total, 'oOrders'=>$oOrders];
        $response = [
            "draw" => $request->input('draw'),
            "recordsTotal" => CarReservation::all()->count(),
            "recordsFiltered" => $data['total'],
            'data' => $data['oOrders']->toArray()
        ];
        return $this->_successJsonResponse($response);
        
    }
}
