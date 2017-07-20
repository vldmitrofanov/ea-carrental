<?php

namespace App\Http\Controllers\Admin;

use App\CarReservationDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\RentalCarReservation;
use App\OfficeLocation;
use App\Types;
use App\CarModelPrice;
use App\CarExtra;
use App\Country;
use App\Setting;
use App\CarModel;
use App\RentalCar;
use App\CarReservation;
use App\CarReservationExtra;
use App\User;
use App\Discount;
use App\CarReservationPayment;
use App\Http\Requests\ReservationRequest;
use \PDF;
use \SendPulse;
use Spatie\GoogleCalendar\Event;
use App\DiscountVolume;

class ReservationsController extends Controller
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
        $oReservations = CarReservation::orderBy('id', 'desc')->paginate(15);
        return view('admin.reservations.index', compact('oReservations'));
    }

    public function loadAll(Request $request){
        $this->_checkAjaxRequest();

        $tableColumns = ['', 'users.name', 'car_models.make', 'rental_cars.registration_number', '', 'rental_car_reservations.status', 'car_reservation_details.total_price',''];
        $orderBy = $request->input('order')[0]['dir']; //asc or desc

        $searchStr = $request->input('search')['value'];
        $start = ($request->input('start')) ?: 0;
        $end = ($request->input('length')) ? $request->input('length') : 10;

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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oOfficeLocations = OfficeLocation::pluck('name', 'id')->toArray();
        $oTypes = Types::get();
        $oCountries = Country::pluck('name', 'id')->toArray();
        return view('admin.reservations.add', compact('oOfficeLocations', 'oTypes', 'oCountries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        $this->_checkAjaxRequest();

        $oCarType = Types::where('id',$request->input('car_type_id'))->first();
        if(!$oCarType){
            return $this->_failedJsonResponse([['Car Type is not valid or has been removed.']]);
        }

        $oCarModel = CarModel::where('id',$request->input('models'))->first();
        if(!$oCarModel){
            return $this->_failedJsonResponse([['Car Make & Model is not valid or has been removed.']]);
        }

        $oCar = RentalCar::where('id',$request->input('car_id'))->first();
        if(!$oCar){
            return $this->_failedJsonResponse([['Car is not valid or has been removed.']]);
        }

//        $googleEvent = new Event;
//        $googleEvent->name = $oCar->make.' - '.$oCar->model.' - '.$oCar->registration_number;
//        $googleEvent->description = $oCar->make.' - '.$oCar->model.' - '.$oCar->registration_number.'<br/>'.$request->input('name').' ( '.$request->input('phone').' )';
//        $googleEvent->startDateTime = Carbon::parse($request->input('date_from'));
//        $googleEvent->endDateTime = Carbon::parse($request->input('date_to'));
//        $googleEventResult = $googleEvent->save();

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $result = \DB::transaction(function () use ($request, $oCar, $oCarType, $oCarModel/*, $googleEventResult*/) {
            try{
                $oUser = User::where('email', $request->input('email'))->first();
                if(!$oUser){
                    $oUser = new User;
                    $oUser->email = $request->input('email');
                    $oUser->username = strstr($request->input('email'), '@', true);
                    $oUser->name = $request->input('name');
                    $oUser->phone = $request->input('phone');
                    $oUser->title = $request->input('title');
                    $oUser->company_name = $request->input('company_name');
                    $oUser->address = $request->input('address');
                    $oUser->state = $request->input('state');
                    $oUser->city = $request->input('city');
                    $oUser->zip = $request->input('zip');
                    $oUser->country_id = $request->input('country_id');
                    $oUser->passport_id = $request->input('passport');
                    $oUser->driver_licence = $request->input('licence');
                    $oUser->rental_form = $request->input('rental_form');
                    $oUser->password = bcrypt('elecon123');
                    $oUser->other_info = '';
                    $oUser->save();
                }
                
                if ($request->file('passport')) {
                    $oUser->passport_id = $request->file('passport')->store('public/users');
                    $oUser->save();
                }

                if ($request->file('licence')) {
                    $oUser->driver_licence = $request->file('licence')->store('public/users');
                    $oUser->save();
                }
                if ($request->file('rental_form')) {
                    $oUser->rental_form = $request->file('rental_form')->store('public/users');
                    $oUser->save();
                }

                $oCarReservation = new CarReservation;
                $oCarReservation->reservation_number = time() . mt_rand(100000, 999999);
                $oCarReservation->ip_address = $request->ip();
                $oCarReservation->user_id = $oUser->id;
                $oCarReservation->processed_on = Carbon::now();
                $oCarReservation->status = $request->input('status');
                $oCarReservation->cc_type = $request->input('cc_type');
                $oCarReservation->cc_num = $request->input('cc_number');
                $oCarReservation->cc_code = $request->input('cc_code');
                $oCarReservation->cc_exp = $request->input('cc_expiration');
                if($oCarReservation->save()){
                    $oCarReservationDetail = new CarReservationDetail;
                    $oCarReservationDetail->reservation_id = $oCarReservation->id;
                    $oCarReservationDetail->car_type_id = $oCarType->id;
                    $oCarReservationDetail->car_model_id = $oCarModel->id;
                    $oCarReservationDetail->car_id = $oCar->id;
                    $oCarReservationDetail->pickup_date = Carbon::parse($request->input('date_from'));
                    $oCarReservationDetail->date_from = Carbon::parse($request->input('date_from'));
                    $oCarReservationDetail->date_to = Carbon::parse($request->input('date_to'));
                    $oCarReservationDetail->pickup_location_id = $request->input('pickup_location_id');
                    $oCarReservationDetail->pickup_near_location = ($request->input('pickup_near_location'))?:'';
                    $oCarReservationDetail->return_location_id = $request->input('return_location_id');
                    $oCarReservationDetail->return_near_location = ($request->input('return_near_location'))?:'';
                    $oCarReservationDetail->rental_days = $request->input('rental_days');
                    $oCarReservationDetail->rental_hours = $request->input('rental_hours');
                    $oCarReservationDetail->price_per_day = $request->input('price_per_day');
                    $oCarReservationDetail->price_per_day_detail = ($request->input('price_per_day_detail'))?:'';
                    $oCarReservationDetail->price_per_hour = $request->input('price_per_hour');
                    $oCarReservationDetail->price_per_hour_detail = ($request->input('price_per_hour_detail'))?:'';
                    $oCarReservationDetail->car_rental_fee = $request->input('car_rental_fee');
                    $oCarReservationDetail->extra_price = $request->input('extra_price');
                    $oCarReservationDetail->insurance = $request->input('insurance');
                    $oCarReservationDetail->sub_total = $request->input('sub_total');
                    $oCarReservationDetail->tax = $request->input('tax');
                    $oCarReservationDetail->total_price = $request->input('total_price');
                    $oCarReservationDetail->required_deposit = $request->input('required_deposit');
                    $oCarReservationDetail->discount_code = $request->input('discount_code');
                    $oCarReservationDetail->discount = ($request->input('discount'))?:0;
                    $oCarReservationDetail->discount_detail = ($request->input('discount_detail'))?:'';
                    $oCarReservationDetail->google_event_id = /*($googleEventResult->id)?:*/'';
                    $oCarReservationDetail->save();
                    
                    if($request->input('extra_id')){
                        foreach ($request->input('extra_id') as $key=>$val) {
                            $oExtra = CarExtra::where('id', $val)->first();
                            $oCarReservationExtra = new CarReservationExtra;
                            $oCarReservationExtra->reservation_id = $oCarReservation->id;
                            $oCarReservationExtra->extra_id = $oExtra->id;
                            $oCarReservationExtra->quantity = $request->input('extra_cnt')[$key];
                            $oCarReservationExtra->price = $oExtra->price;
                            $oCarReservationExtra->extended_notes = '';
                            $oCarReservationExtra->save();
                        }
                    }
                    
                    $this->_sendReservationEmail($oCarReservation);
                    
                    return $this->_successJsonResponse(['message'=>'Reservation information saved.', 'data' => $oCarReservation]);
                }else{
                    return $this->_failedJsonResponse([['Failed to save <strong>Reservation Information</strong>.']]);
                }

            }catch (\Exception $e) {
                return $this->_failedJsonResponse([[$e->getMessage()]]);
            }
        });
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oReservation = CarReservation::where('id', $id)->firstOrFail();
        $oOfficeLocations = OfficeLocation::pluck('name', 'id')->toArray();
//        $oCarTypes = CarType::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $oTypes = Types::get();
        $oCarModels = CarModel::where('type_id', $oReservation->details->first()->car_type_id)->orderBy('make', 'ASC')->orderBy('model', 'ASC')->get();
        $oCountries = Country::pluck('name', 'id')->toArray();
//        $oCars = CarModel::where('id',$oReservation->details->first()->car_model_id)->first()->cars()->get();
        $oCars = RentalCar::where('model_id',$oReservation->details->first()->car_model_id)->get();
        $oExtras = CarModel::where('id',$oReservation->details->first()->car_model_id)->first()->extras()->get();
        $settingsArr = $this->option_arr;
        $currencySign = $this->getCurrencySign($this->option_arr['currency']);
        return view('admin.reservations.edit', compact('oOfficeLocations', 'oCarModels', 'oTypes', 'oCountries', 'oReservation', 'oCars', 'currencySign', 'settingsArr', 'oExtras'));
    }

    public function addPayment(Request $request){
        $this->_checkAjaxRequest();

        $oCarReservation = CarReservation::where('id',$request->input('id'))->first();
        if(!$oCarReservation){
            return $this->_failedJsonResponse([['Reservation is not valid or has been removed.']]);
        }

        $oCarReservationPayment = new CarReservationPayment;
        $oCarReservationPayment->reservation_id = $oCarReservation->id;
        $oCarReservationPayment->payment_type = '';
        $oCarReservationPayment->save();
        $data['payment'] = $oCarReservationPayment;
        $data['amountPaid'] = $oCarReservation->payments->where('status','paid')->sum('amount');
        return $this->_successJsonResponse(['message'=>'Reservation Payment information saved.', 'data' => $data]);
    }

    public function removePayment(Request $request){
        $this->_checkAjaxRequest();

        $oCarReservation = CarReservation::where('id',$request->input('id'))->first();
        if(!$oCarReservation){
            return $this->_failedJsonResponse([['Reservation is not valid or has been removed.']]);
        }

        $oCarReservationPayment = CarReservationPayment::where('id', $request->input('payment_id'))->first();
        if(!$oCarReservationPayment){
            return $this->_failedJsonResponse([['Reservation Payment is not valid or has been removed.']]);
        }
        $oCarReservationPayment->delete();
        $data['amountPaid'] = $oCarReservation->payments->where('status','paid')->sum('amount');
        return $this->_successJsonResponse(['message'=>'Reservation Payment information saved.', 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, $id)
    {

        $oCarType = Types::where('id',$request->input('car_type_id'))->first();
        if(!$oCarType){
            return $this->_failedJsonResponse([['Car Type is not valid or has been removed.']]);
        }

        $oCarModel = CarModel::where('id',$request->input('models'))->first();
        if(!$oCarModel){
            return $this->_failedJsonResponse([['Car Make & Model is not valid or has been removed.']]);
        }

        $oCar = RentalCar::where('id',$request->input('car_id'))->first();
        if(!$oCar){
            return $this->_failedJsonResponse([['Car is not valid or has been removed.']]);
        }

        $oCarReservation = CarReservation::where('id',$request->input('id'))->first();
        if(!$oCarReservation){
            return $this->_failedJsonResponse([['Reservation is not valid or has been removed.']]);
        }

        $oReservationDetail = $oCarReservation->details->first();

//        $googleEvent = new Event;
//        $googleEvent->name = $oCar->make.' - '.$oCar->model.' - '.$oCar->registration_number;
//        $googleEvent->description = $oCar->make.' - '.$oCar->model.' - '.$oCar->registration_number.'<br/>'.$request->input('name').' ( '.$request->input('phone').' )';
//        $googleEvent->startDateTime = Carbon::parse($request->input('date_from'));
//        $googleEvent->endDateTime = Carbon::parse($request->input('date_to'));
//        $googleEvent->id = $oReservationDetail->google_event_id;
//        $googleEventResult = $googleEvent->save();

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $result = \DB::transaction(function () use ($request, $oCar, $oCarType, $oCarReservation, $oCarModel/*, $googleEventResult*/) {
            try{
                $oUser = User::where('id', $oCarReservation->user_id)->first();
                if(!$oUser){
                    return $this->_failedJsonResponse([['User Information is not valid or has been removed.']]);
                }
                $oUser->email = $request->input('email');
                $oUser->name = $request->input('name');
                $oUser->phone = $request->input('phone');
                $oUser->title = $request->input('title');
                $oUser->company_name = $request->input('company_name');
                $oUser->address = $request->input('address');
                $oUser->state = $request->input('state');
                $oUser->city = $request->input('city');
                $oUser->zip = $request->input('zip');
                $oUser->country_id = $request->input('country_id');
                $oUser->passport_id = $request->input('passport');
                $oUser->driver_licence = $request->input('licence');
                $oUser->rental_form = $request->input('rental_form');
                    
                $oUser->save();
                
                if ($request->file('passport')) {
                    $oUser->passport_id = $request->file('passport')->store('public/users');
                    $oUser->save();
                }
                if ($request->file('licence')) {
                    $oUser->driver_licence = $request->file('licence')->store('public/users');
                    $oUser->save();
                }
                if ($request->file('rental_form')) {
                    $oUser->rental_form = $request->file('rental_form')->store('public/users');
                    $oUser->save();
                }
//updating the reservation infor
                $oCarReservation->status = $request->input('status');
                $oCarReservation->cc_type = $request->input('cc_type');
                $oCarReservation->cc_num = $request->input('cc_number');
                $oCarReservation->cc_code = $request->input('cc_code');
                $oCarReservation->cc_exp = ($request->input('cc_expiration'))?:'';
                $oCarReservation->save();

//updating the reservation detail
                $oCarReservationDetail = $oCarReservation->details->first();
                $oCarReservationDetail->car_type_id = $oCarType->id;
                $oCarReservationDetail->car_model_id = $oCarModel->id;
                $oCarReservationDetail->car_id = $oCar->id;
                $oCarReservationDetail->return_date = Carbon::parse($request->input('return_date'));
                $oCarReservationDetail->pickup_date = Carbon::parse($request->input('pickup_date'));
                $oCarReservationDetail->date_from = Carbon::parse($request->input('date_from'));
                $oCarReservationDetail->date_to = Carbon::parse($request->input('date_to'));
                $oCarReservationDetail->pickup_location_id = $request->input('pickup_location_id');
                $oCarReservationDetail->pickup_near_location = ($request->input('pickup_near_location'))?:'';
                $oCarReservationDetail->return_location_id = $request->input('return_location_id');
                $oCarReservationDetail->return_near_location = ($request->input('return_near_location'))?:'';
                $oCarReservationDetail->rental_days = $request->input('rental_days');
                $oCarReservationDetail->rental_hours = $request->input('rental_hours');
                $oCarReservationDetail->price_per_day = $request->input('price_per_day');
                $oCarReservationDetail->price_per_day_detail = ($request->input('price_per_day_detail'))?:'';
                $oCarReservationDetail->price_per_hour = $request->input('price_per_hour');
                $oCarReservationDetail->price_per_hour_detail = ($request->input('price_per_hour_detail'))?:'';
                $oCarReservationDetail->car_rental_fee = $request->input('car_rental_fee');
                $oCarReservationDetail->extra_price = $request->input('extra_price');
                $oCarReservationDetail->insurance = $request->input('insurance');
                $oCarReservationDetail->sub_total = $request->input('sub_total');
                $oCarReservationDetail->tax = $request->input('tax');
                $oCarReservationDetail->total_price = $request->input('total_price');
                $oCarReservationDetail->required_deposit = $request->input('required_deposit');
                $oCarReservationDetail->pickup_mileage = ($request->input('pickup_mileage'))?:0;
                $oCarReservationDetail->return_mileage = ($request->input('return_mileage'))?:0;
                $oCarReservationDetail->google_event_id = /*($googleEventResult->id)?:*/'' ;
                $oCarReservationDetail->save();

//updating the extras ifo
                if($request->input('extra_id')){
                    foreach ($request->input('extra_id') as $key=>$val) {
                        $oExtra = CarExtra::where('id', $val)->first();
                        $oCarReservationExtra = CarReservationExtra::where('id', $key)->first();
                        if(!$oCarReservationExtra) {
                            $oCarReservationExtra = new CarReservationExtra;
                            $oCarReservationExtra->reservation_id = $oCarReservation->id;
                        }
                        $oCarReservationExtra->extra_id = $oExtra->id;
                        $oCarReservationExtra->quantity = $request->input('extra_cnt')[$key];
                        $oCarReservationExtra->price = $oExtra->price;
                        $oCarReservationExtra->extended_notes = '';
                        $oCarReservationExtra->save();
                    }
                }

//updating the payment info
                if($request->input('payment_method')){
                foreach ($request->input('payment_method') as $key=>$val) {
                    $oPayment = CarReservationPayment::where('id', $key)->first();
                    $oPayment->payment_method = $val;
                    $oPayment->payment_type = $request->input('payment_type')[$key];
                    $oPayment->amount = $request->input('payment_amount')[$key];
                    $oPayment->status = $request->input('payment_status')[$key];
                    $oPayment->save();
                }
                }

                if($request->input('return_mileage')>0) {
                    $oCar->current_mileage = $request->input('return_mileage');
                    $oCar->save();
                }

                return $this->_successJsonResponse(['message'=>'Reservation information saved.']);
            }catch (\Exception $e) {
                return $this->_failedJsonResponse([[$e->getMessage()]]);
            }
        });
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oCarReservation = CarReservation::where('id',$id)->first();
        if(!$oCarReservation){
            \Session::flash('flash_message', 'Reservation is not valid or has been removed.');
            \Session::flash('flash_type', 'alert-error');
            return \Redirect::to('admin/reservations');
        }

        $oCarReservation->delete();
        \Session::flash('flash_message', 'Reservation Information has been removed.');
        \Session::flash('flash_type', 'alert-success');
        return \Redirect::to('admin/reservations');
    }

    //o_booking_periods = calculate_rental_fee
    public function getRealRentalDays($datetime_from, $datetime_to)
    {
        $o_new_day_per_day =0 ;

        $seconds = abs(strtotime($datetime_from) - strtotime($datetime_to));
        $rental_days = floor($seconds / 86400);
        $rental_hours = ceil($seconds / 3600);
        $extra_hours = intval($rental_hours - ($rental_days * 24));

        if ($this->option_arr['calculate_rental_fee'] == 'perday')
        {
            if ($extra_hours > 0)
            {
                if ($o_new_day_per_day == 0)
                {
                    $rental_days += 1;
                }
                if ($o_new_day_per_day > 0 && $extra_hours > $o_new_day_per_day)
                {
                    $rental_days += 1;
                }
            }
        }

        return $rental_days;
    }


    public function getPrices($datetime_from, $datetime_to, $oCarModel)
    {
        $o_new_day_per_day =0 ;
//        $oBookingPeriod = Setting::where('key', 'calculate_rental_fee')->first();

        $date_from = date('Y-m-d',strtotime($datetime_from));
        $date_to = date('Y-m-d',strtotime($datetime_to));

        $seconds = abs(strtotime($datetime_from) - strtotime($datetime_to));
        $rental_days = floor($seconds / 86400);
        $rental_hours = ceil($seconds / 3600);
        $extra_hours = intval($rental_hours - ($rental_days * 24));

        $price = 0;
        $price_per_day = 0;
        $price_per_hour = 0;
        $day_added = 0;
        $price_per_day_detail = '';
        $price_per_hour_detail = '';
        $price_per_day_arr = array();
        $price_per_hour_arr = array();

        $begin_date = strtotime($date_from);
        $end_date = strtotime($date_to);
        $i = $begin_date;
        $j = 1;

        if($this->option_arr['calculate_rental_fee']  == 'perday')
        {
            if($extra_hours > 0)
            {
                if($o_new_day_per_day == 0)
                {
                    $rental_days++;
                    $day_added = 1;
                }
                if($o_new_day_per_day > 0 && $extra_hours > $o_new_day_per_day){
                    $rental_days++;
                    $day_added = 1;
                }
            }
            while ($j <= $rental_days)
            {
                $price_arr = CarModelPrice::where('id', $oCarModel->id)
                    ->whereRaw("`price_per` = 'day'")
                    ->whereRaw('("'.$rental_days.'" BETWEEN `from` AND `to` )')
                    ->whereRaw("('" . date('Y-m-d',$i) . "' BETWEEN `date_from` AND `date_to` )")
                    ->first();

//                $price_arr = $pjPriceModel->reset()
//                    ->where('t1.type_id',$oCarType->id)
//                    ->where("t1.id > 0 AND ('" . date('Y-m-d',$i) . "' BETWEEN t1.date_from AND t1.date_to ) AND price_per = 'day'")
//                    ->where('("'.$rental_days.'" BETWEEN t1.from AND t1.to )')
//                    ->limit(1)
//                    ->findAll()->getData();

                if ($price_arr)
                {
                    $price += (float) $price_arr->price;
                    $price_per_day_arr[(string) $price_arr->price][] = $i;
                }else{
                    $price += $oCarModel->price_per_day;
                    $price_per_day_arr[(string) $oCarModel->price_per_day][] = $i;
                }

                $j++;
                $i += 86400;
            }
            $price_per_day = $price;
        } elseif($this->option_arr['calculate_rental_fee']  == 'perhour'){

            if($rental_hours > 0)
            {
                $j = 1;
                while ($j <= $rental_hours)
                {
                    $price_arr = CarModelPrice::where('id', $oCarModel->id)
                        ->whereRaw("price_per = 'hour'")
                        ->whereRaw('("'.$rental_hours.'" BETWEEN `from` AND `to` )')
                        ->whereRaw("('" . date('Y-m-d', strtotime($datetime_from) + ($j * 3600)) . "' BETWEEN date_from AND date_to )")
                        ->first();
//                    $price_arr = $pjPriceModel->reset()
//                        ->where('t1.type_id',$oCarType->id)
//                        ->where('t1.id > 0 AND ("'.date('Y-m-d', strtotime($datetime_from) + ($j * 3600)).'" BETWEEN t1.date_from AND t1.date_to ) AND price_per = "hour"')
//                        ->where('("'.$rental_hours.'" BETWEEN t1.from AND t1.to )')
//                        ->limit(1)
//                        ->findAll()->getData();
                    if ($price_arr) {
                        $price += (float) $price_arr->price;
                        $price_per_hour_arr[(string) $price_arr->price][] = $j;
                    }else{
                        $price += $oCarModel->price_per_hour;
                        $price_per_hour_arr[(string) $oCarModel->price_per_hour][] = $j;
                    }
                    $j++;
                }
            }
            $price_per_hour = $price;
        } elseif($this->option_arr['calculate_rental_fee']  == 'both'){
            while ($j <= $rental_days)
            {
                $price_arr = CarModelPrice::where('id', $oCarModel->id)
                    ->whereRaw("price_per = 'day'")
                    ->whereRaw('("'.$rental_hours.'" BETWEEN `from` AND `to` )')
                    ->whereRaw("('" . date('Y-m-d',$i) . "' BETWEEN date_from AND date_to )")
                    ->first();

//                $price_arr = $pjPriceModel->reset()
//                    ->where('t1.type_id',$oCarType->id)
//                    ->where('t1.id > 0 AND ("'.date('Y-m-d',$i).'" BETWEEN t1.date_from AND t1.date_to ) AND price_per = "day"')
//                    ->where('("'.$rental_days.'" BETWEEN t1.from AND t1.to )')
//                    ->limit(1)
//                    ->findAll()->getData();
                if ($price_arr)
                {
                    $price += (float) $price_arr->price;
                    $price_per_day_arr[(string) $price_arr->price][] = $i;
                }else{
                    $price += $oCarModel->price_per_day;
                    $price_per_day_arr[(string) $oCarModel->price_per_day][] = $i;
                }

                $j++;
                $i += 86400;
            }
            $price_per_day = $price;

            $_end_ts = strtotime($datetime_from) + ($rental_days * 86400);
            if($extra_hours > 0)
            {
                $j = 1;
                while ($j <= $extra_hours)
                {
                    $price_arr = CarModelPrice::where('id', $oCarModel->id)
                        ->whereRaw("price_per = 'hour'")
                        ->whereRaw('("'.$rental_hours.'" BETWEEN `from` AND `to` )')
                        ->whereRaw("('" . date('Y-m-d', $_end_ts + ($j * 3600)) . "' BETWEEN date_from AND date_to )")
                        ->first();

//                    $price_arr = $pjPriceModel->reset()
//                        ->where('t1.type_id',$oCarType->id)
//                        ->where('t1.id > 0 AND ("'.date('Y-m-d', $_end_ts + ($j * 3600)).'" BETWEEN t1.date_from AND t1.date_to ) AND price_per = "hour"')
//                        ->where('("'.$extra_hours.'" BETWEEN t1.from AND t1.to )')
//                        ->limit(1)
//                        ->findAll()->getData();
                    if ($price_arr) {
                        $price += (float) $price_arr->price;
                        $price_per_hour_arr[(string) $price_arr->price][] = $j;
                    }else{
                        $price += $oCarModel->price_per_hour;
                        $price_per_hour_arr[(string) $oCarModel->price_per_hour][] = $j;
                    }
                    $j++;
                }
            }
            $price_per_hour = $price - $price_per_day;
        }

        if(!empty($price_per_day_arr))
        {
            $_day_key_arr = array();
            $_day_detail_arr = array();
            foreach($price_per_day_arr as $k => $v)
            {
                $_day_key_arr[] = $k;
            }
            foreach($_day_key_arr as $v)
            {
                $number_of_days = count($price_per_day_arr[$v]);
                $_day_detail_arr[] = $number_of_days . ' days' . ' x ' . $this->formatCurrencySign(number_format($v, 2), $this->option_arr['currency']);
            }
            $price_per_day_detail = join("<br/>", $_day_detail_arr);
        }
        if(!empty($price_per_hour_arr))
        {
            $_hour_key_arr = array();
            $_hour_detail_arr = array();
            foreach($price_per_hour_arr as $k => $v)
            {
                $_hour_key_arr[] = $k;
            }
            foreach($_hour_key_arr as $v)
            {
                $number_of_hours = count($price_per_hour_arr[$v]);
                $_hour_detail_arr[] = $number_of_hours . ' hours' .' x ' . $this->formatCurrencySign(number_format($v, 2), $this->option_arr['currency']);
            }
            $price_per_hour_detail = join("<br/>", $_hour_detail_arr);
        }

        return array('price_per_day' => $price_per_day, 'price_per_day_detail' => $price_per_day_detail,
            'price_per_hour' => $price_per_hour, 'price_per_hour_detail' => $price_per_hour_detail,
            'price' => $price, 'day_added' => $day_added);
    }

    public function getDefaultPrices($datetime_from, $datetime_to, $oCarModel)
    {
        $o_new_day_per_day =0 ;

        $date_from = date('Y-m-d',strtotime($datetime_from));
        $date_to = date('Y-m-d',strtotime($datetime_to));

        $seconds = abs(strtotime($datetime_from) - strtotime($datetime_to));
        $rental_days = floor($seconds / 86400);
        $rental_hours = ceil($seconds / 3600);
        $extra_hours = intval($rental_hours - ($rental_days * 24));

        $price = 0;
        $price_per_day = 0;
        $price_per_hour = 0;
        $price_per_day_detail = '';
        $price_per_hour_detail = '';
        $day_added = 0;

        if($this->option_arr['calculate_rental_fee']  == 'perday')
        {
            if($extra_hours > 0)
            {
                if($o_new_day_per_day == 0)
                {
                    $rental_days++;
                    $day_added = 1;
                }
                if($o_new_day_per_day > 0 && $extra_hours > $o_new_day_per_day){
                    $rental_days++;
                    $day_added = 1;
                }
            }
            $price = $oCarModel->price_per_day * $rental_days;
            $price_per_day = $price;
            $price_per_day_detail = $rental_days . ' days ' . ' x ' . $this->formatCurrencySign(round($oCarModel->price_per_day, 2), $this->option_arr['currency']);
        } elseif($this->option_arr['calculate_rental_fee']  == 'perhour'){

            $price = $oCarModel->price_per_hour * $rental_hours;
            $price_per_hour = $price;
            $price_per_hour_detail = $rental_hours . ' hours ' . ' x ' . $this->formatCurrencySign(round($oCarModel->price_per_hour, 2), $this->option_arr['currency']);

        } elseif($this->option_arr['calculate_rental_fee']  == 'both'){

            $price = $oCarModel->price_per_day * $rental_days;
            $price_per_day = $price;
            $price_per_day_detail = $rental_days . ' days ' . ' x ' .$this->formatCurrencySign(round($oCarModel->price_per_day, 2), $this->option_arr['currency']);

            $price += $oCarModel->price_per_hour * $extra_hours;
            $price_per_hour = $price - $price_per_day;
            $price_per_hour_detail = $extra_hours . ' hours' . ' x ' . $this->formatCurrencySign(round($oCarModel->price_per_hour, 2), $this->option_arr['currency']);

        }

        return array('price_per_day' => $price_per_day, 'price_per_day_detail' => $price_per_day_detail,
            'price_per_hour' => $price_per_hour, 'price_per_hour_detail' => $price_per_hour_detail,
            'price' => $price, 'day_added' => $day_added);
    }

    public function loadCarPrices(Request $request){
        $this->_checkAjaxRequest();
        $o_new_day_per_day =0 ;
        $oSetting = Setting::where('key', 'currency')->first();
        $currency = ($oSetting)?$oSetting->value:'USD';

        $data['time'] = $this->calculateDateDiff($request->input('date_from'), $request->input('date_to'));
        
        $oCarType = Types::where('id',$request->input('car_type_id'))->first();
        if(!$oCarType){
            return $this->_failedJsonResponse([['Car Type is not valid or has been removed.']]);
        }

        $oCarModel = CarModel::where('id',$request->input('models'))->first();
        if(!$oCarModel){
            return $this->_failedJsonResponse([['Car Model is not valid or has been removed.']]);
        }

        $oRentalCar = RentalCar::where('id',$request->input('car_id'))->first();
        if(!$oRentalCar){
            return $this->_failedJsonResponse([['Car is not valid or has been removed.']]);
        }
        
        $carAvailable = $this->checkCarAvailability($request);
        if($carAvailable['code']==100){
            return $this->_failedJsonResponse([['Reservation date range is not valid.']]);
        }else if($carAvailable['code']==300){
            return $this->_failedJsonResponse([['Car Type and Car is not valid.']]);
        }else if($carAvailable['code']==150){
            return $this->_failedJsonResponse([['Car is <strong>not available</strong> during selected time period. Please select another Car and/or change time period.']]);
        }
        $oPrices = $oCarModel->prices()
                    ->where('car_model_prices.date_from','>=',Carbon::parse($request->input('date_from'))->format('Y-m-d'))
                    ->where('car_model_prices.date_to','<=',Carbon::parse($request->input('date_to'))->format('Y-m-d'))
                    ->get();

        $rental_days = $data['time']['days'];
        $rental_hours = $data['time']['hours'];
        $hours = intval($rental_hours - ($rental_days * 24));

        $hasVDiscount = false;
        $price = 0;
        $extra_price = 0;
        $price_per_day = 0;
        $price_per_hour = 0;
        $price_per_day_detail = '';
        $price_per_hour_detail = '';
        $car_rental_fee = 0;
        $car_rental_fee_detail = '';
        $sub_total = 0;
        $total_price = 0;
        $required_deposit = 0;
        $insurance_detail = '';
        $tax_detail = '';
        $required_deposit_detail = '';
        $discount = 0;
        $discount_detail = '';

        $car_rental_fee_arr = array();
        $e_arr = array();
        $extra_arr = array();
        $extra_qty_arr = array();
        if($request->input('extra_id')){
            foreach ($request->input('extra_id') as $key => $extra_id){
                if((int) $extra_id){
                    $e_arr[] = $extra_id;
                    $extra_qty_arr[$extra_id] = $request->input('extra_cnt')[$key];
                }

            }
        }

        if(count($e_arr) > 0){
            $extra_arr = CarExtra::whereIn('id', $e_arr)->get();
        }

        $real_rental_days = $this->getRealRentalDays(Carbon::parse($request->input('date_from')), Carbon::parse($request->input('date_to')));
        foreach ($extra_arr as $key => $val){
            switch ($val->per)
            {
                case 'day':
                    $extra_price +=  $val->price * $real_rental_days * $extra_qty_arr[$val->id];
                    break;
                case 'booking':
                    $extra_price +=  $val->price * $extra_qty_arr[$val->id];
                    break;
            }
        }


        $price_arr = $this->getPrices(Carbon::parse($request->input('date_from')), Carbon::parse($request->input('date_to')), $oCarModel);
        if($price_arr['price'] == 0)
        {
            $price_arr = $this->getDefaultPrices(Carbon::parse($request->input('date_from')), Carbon::parse($request->input('date_to')), $oCarModel);
        }

        $car_rental_fee = $price_arr['price'];
        $price_per_day = $price_arr['price_per_day'];
        $price_per_hour = $price_arr['price_per_hour'];
        $price_per_day_detail = $price_arr['price_per_day_detail'];
        $price_per_hour_detail = $price_arr['price_per_hour_detail'];
        $price = $car_rental_fee + $extra_price;

        $insurance_types = [
            'percent' => 'Percent',
            'perday' => 'Per day',
            'perbooking' => 'Per Reservation',
        ];
        $insurance = $this->option_arr['insurance_payment'];
        $insurance_detail = $this->formatCurrencySign($this->option_arr['insurance_payment'], $this->option_arr['currency']) . ' ' . strtolower($insurance_types['perbooking']);

        if($this->option_arr['insurance_type'] == 'percent')
        {
            $insurance = ($price * $this->option_arr['insurance_payment']) / 100;
            $insurance_detail = $this->option_arr['insurance_payment'] . '% of ' . $this->formatCurrencySign($price, $this->option_arr['currency']);
        }elseif($this->option_arr['insurance_type'] == 'perday'){
            $_rental_days = $rental_days;
            if($hours > 0)
            {
                if($o_new_day_per_day == 0 && $this->option_arr['rental_fee'] == 'perday')
                {
                    $_rental_days++;
                }
                if($o_new_day_per_day > 0 && $hours > $o_new_day_per_day){
                    $this->option_arr++;
                }
            }
            $insurance = $_rental_days * $this->option_arr['insurance_payment'];
            $insurance_detail = $this->formatCurrencySign($this->option_arr['insurance_payment'], $this->option_arr['currency']) . ' ' . strtolower($insurance_types['perday']);
        }

        $sub_total = $car_rental_fee + $extra_price + $insurance;
        $tax =  $this->option_arr['tax_payment'];
        if($this->option_arr['tax_type'] == 'percent')
        {
            $tax = ($sub_total * $this->option_arr['tax_payment']) / 100;
            $tax_detail = $this->option_arr['tax_payment'] . '% of ' . $this->formatCurrencySign($sub_total, $this->option_arr['currency']);
        }
        $total_price = $sub_total + $tax;
        $security  = $this->option_arr['security_payment'];
        /*switch ($this->option_arr['deposit_type'])
        {
            case 'percent':
                $required_deposit = ($total_price * $this->option_arr['deposit_payment']) / 100;
                $required_deposit_detail = $this->option_arr['deposit_payment'] . '% of '. $this->formatCurrencySign($total_price, $this->option_arr['currency']);
                break;
            case 'amount':
                $required_deposit = $this->option_arr['deposit_payment'];
                $required_deposit_detail = '';
                break;
        }*/

        $required_deposit =0 ;
        $required_deposit_detail = '';
        
        $discount_info = false;
        if($request->input('discount_code')){
            $discount_info = $this->getDiscountInfo($request);
        }
        
        $oVDisocunt = false;
        $daysDiff = Carbon::parse($request->input('date_to'))->diffInDays(Carbon::parse($request->input('date_from')));
        $weeksDiff = Carbon::parse($request->input('date_to'))->diffInWeeks(Carbon::parse($request->input('date_from')));
        $monthsDiff = Carbon::parse($request->input('date_to'))->diffInMonths(Carbon::parse($request->input('date_from')));
        // check if there is any volume discount available for the period
        if($daysDiff>0){
            $oVDisocunt = DiscountVolume::whereIn('id', function($query) use($request){
                            $query->select('discount_package_id')->from('discount_package_periods')
                                ->distinct()
                                //  ->whereRaw(" start_date <= '".Carbon::parse($request->input('date_from'))."' and end_date >= '".Carbon::parse($request->input('date_to'))."' ");
                                ->whereRaw(" DATE_FORMAT(start_date,'%Y-%m-%d') <= '".Carbon::now()->format('Y-m-d')."' and DATE_FORMAT(end_date,'%Y-%m-%d') >= '".Carbon::now()->format('Y-m-d')."' ");
                        })
                        ->where('booking_duration', $daysDiff)
                        ->where('booking_duration_type','days')
                        ->where('status',true)
                        ->first();
        }/*else if($daysDiff==0 && $weeksDiff>0 && $monthsDiff==0){
            echo "w";
            $oVDisocunt = DiscountVolume::whereIn('id', function($query) use($request){
                            $query->select('discount_package_id')->from('discount_package_periods')
                                ->distinct()
                                //  ->whereRaw(" start_date <= '".Carbon::parse($request->input('date_from'))."' and end_date >= '".Carbon::parse($request->input('date_to'))."' ");
                                ->whereRaw(" DATE_FORMAT(start_date,'%Y-%m-%d') <= '".Carbon::now()->format('Y-m-d')."' and DATE_FORMAT(end_date,'%Y-%m-%d') >= '".Carbon::now()->format('Y-m-d')."' ");
                        })
                        ->where('booking_duration', $weeksDiff)
                        ->where('booking_duration_type','weeks')
                        ->where('status',true)
                        ->toSql();
        }else if($daysDiff==0 && $weeksDiff==0 && $monthsDiff>0){
            echo "m";
            $oVDisocunt = DiscountVolume::whereIn('id', function($query) use($request){
                            $query->select('discount_package_id')->from('discount_package_periods')
                                ->distinct()
                                //  ->whereRaw(" start_date <= '".Carbon::parse($request->input('date_from'))."' and end_date >= '".Carbon::parse($request->input('date_to'))."' ");
                                ->whereRaw(" DATE_FORMAT(start_date,'%Y-%m-%d') <= '".Carbon::now()->format('Y-m-d')."' and DATE_FORMAT(end_date,'%Y-%m-%d') >= '".Carbon::now()->format('Y-m-d')."' ");
                        })
                        ->where('booking_duration', $monthsDiff)
                        ->where('booking_duration_type','months')
                        ->where('status',true)
                        ->toSql();
        }*/
        
        if($oVDisocunt) {
            $vDiscount = $this->_getVolumeDiscountInfo(Carbon::parse($request->input('date_from')), Carbon::parse($request->input('date_to')), $oCarModel->id, $request);
            if($vDiscount){
                $hasVDiscount = true;
                $discount_info = $vDiscount;
            }
        }
        
        if(is_array($discount_info)){
            switch ($discount_info['amount_type']){
                case 'percent':
                    $discount = ($total_price * $discount_info['amount']) / 100;
                    $discount_detail = $discount_info['amount'] . '% of '. $this->formatCurrencySign($total_price, $this->option_arr['currency']);
                    break;
                case 'amount':
                    $discount = $discount_info['amount'];
                    $discount_detail = '';
                    break;
            }
        }

        $total_price = $total_price - $discount;
        $total_amount_due = $total_price;
        if($request->input('status') == 'confirmed'){
            $total_amount_due = $total_price - $required_deposit;
        }

        $price_per_day = number_format($price_per_day, 2, '.', '');
        $price_per_hour = number_format($price_per_hour, 2, '.', '');
        $car_rental_fee = number_format($car_rental_fee, 2, '.', '');
        $extra_price = number_format($extra_price, 2, '.', '');
        $discount = number_format($discount, 2, '.', '');
        $insurance = number_format($insurance, 2, '.', '');
        $sub_total = number_format($sub_total, 2, '.', '');
        $tax = number_format($tax, 2, '.', '');
        $total_price = number_format($total_price, 2, '.', '');
        $required_deposit = number_format($required_deposit, 2, '.', '');
        $total_amount_due = number_format($total_amount_due, 2, '.', '');
        $currency = $this->option_arr['currency'];

        $price_per_day_label = $this->formatCurrencySign($price_per_day, $this->option_arr['currency']);
        $price_per_hour_label = $this->formatCurrencySign($price_per_hour, $this->option_arr['currency']);
        $car_rental_fee_label = $this->formatCurrencySign($car_rental_fee, $this->option_arr['currency']);
        $extra_price_label = $this->formatCurrencySign($extra_price, $this->option_arr['currency']);
        $discount_label = $this->formatCurrencySign($discount, $this->option_arr['currency']);
        $insurance_label = $this->formatCurrencySign($insurance, $this->option_arr['currency']);
        $sub_total_label = $this->formatCurrencySign($sub_total, $this->option_arr['currency']);
        $tax_label = $this->formatCurrencySign($tax, $this->option_arr['currency']);
        $total_price_label = $this->formatCurrencySign($total_price, $this->option_arr['currency']);
        $required_deposit_label = $this->formatCurrencySign($required_deposit, $this->option_arr['currency']);
        $total_amount_due_label = $this->formatCurrencySign($total_amount_due, $this->option_arr['currency']);

        if($price_per_day > 0)
        {
            $car_rental_fee_arr[] = $price_per_day_label;
        }
        if($price_per_hour > 0)
        {
            $car_rental_fee_arr[] = $price_per_hour_label;
        }
        $car_rental_fee_detail = join(" + ", $car_rental_fee_arr);
        $rental_time = '';
        if($rental_days > 0 || $hours > 0){
            if($rental_days > 0){
                $rental_time .= $rental_days . ' days';
            }
            if($hours > 0){
                $rental_time .= ' ' . $hours . ' hours';
            }
        }

        $data['prices'] = compact('rental_time', 'rental_days', 'hours','hasVDiscount',
            'price_per_day', 'price_per_hour', 'price_per_day_detail', 'price_per_hour_detail',
            'car_rental_fee', 'extra_price', 'discount', 'insurance', 'sub_total', 'tax',
            'total_price', 'required_deposit', 'total_amount_due',
            'price_per_day_label', 'price_per_hour_label', 'car_rental_fee_label',
            'extra_price_label', 'insurance_label', 'sub_total_label', 'tax_label',
            'total_price_label', 'required_deposit_label', 'total_amount_due_label', 'discount_label',
            'car_rental_fee_detail', 'insurance_detail', 'discount_detail', 'tax_detail', 'required_deposit_detail');

        $oCar = $oCarModel->cars()->where('rental_cars.id', $request->input('car_id'))->first();

        $data['type'] = $oCarType;
        $data['model'] = $oCarModel;
        $data['car'] = $oCar;
        $data['currency'] = $currency;
        $data['currencySign'] = $this->getCurrencySign($currency);
        return $this->_successJsonResponse(['message'=>'Car Type Custom Rate information saved.', 'data' => $data]);
    }

    private function _getVolumeDiscountInfo($start, $end, $modelId, $request){
        $daysDiff = Carbon::parse($start)->diffInDays($end);
        $weeksDiff = Carbon::parse($start)->diffInWeeks($end);
        $monthsDiff = Carbon::parse($start)->diffInMonths($end);
      
        if($daysDiff>0){
            if((int)$request->input('id')>0){
                $oReservation = CarReservation::where('id', $request->input('id'))->firstOrFail();
                $oDiscount = DiscountVolume::Join('discount_package_periods', 'discount_packages.id', '=', 'discount_package_periods.discount_package_id')
                    ->Join('discount_package_models', 'discount_packages.id', '=', 'discount_package_models.discount_package_id')
                    ->whereRaw('DATE_FORMAT(start_date,\'%Y-%m-%d\') <= "'.Carbon::parse($oReservation->processed_on)->format('Y-m-d').'"')
                    ->whereRaw('DATE_FORMAT(end_date,\'%Y-%m-%d\') >= "'.Carbon::parse($oReservation->processed_on)->format('Y-m-d').'"')
                    ->whereRaw("discount_package_models.model_id = $modelId")
                    ->where('discount_packages.booking_duration', $daysDiff)
                    ->where('discount_packages.booking_duration_type','days')
                    ->where('discount_packages.status',true)
                    ->first();
            }else{
                $oDiscount = DiscountVolume::Join('discount_package_periods', 'discount_packages.id', '=', 'discount_package_periods.discount_package_id')
                    ->Join('discount_package_models', 'discount_packages.id', '=', 'discount_package_models.discount_package_id')
                    ->whereRaw('DATE_FORMAT(start_date,\'%Y-%m-%d\') <= "'.Carbon::now()->format('Y-m-d').'"')
                    ->whereRaw('DATE_FORMAT(end_date,\'%Y-%m-%d\') >= "'.Carbon::now()->format('Y-m-d').'"')
                    ->whereRaw("discount_package_models.model_id = $modelId")
                    ->where('discount_packages.booking_duration', $daysDiff)
                    ->where('discount_packages.booking_duration_type','days')
                    ->where('discount_packages.status',true)
                    ->first();
            }
        }/*else if($daysDiff==0 && $weeksDiff>0 && $monthsDiff==0){
            $oDiscount = DiscountVolume::Join('discount_package_periods', 'discount_packages.id', '=', 'discount_package_periods.discount_package_id')
                ->Join('discount_package_models', 'discount_packages.id', '=', 'discount_package_models.discount_package_id')
                ->whereRaw('DATE_FORMAT(start_date,\'%Y-%m-%d\') <= "'.Carbon::now()->format('Y-m-d').'"')
                ->whereRaw('DATE_FORMAT(end_date,\'%Y-%m-%d\') >= "'.Carbon::now()->format('Y-m-d').'"')
                ->whereRaw("discount_package_models.model_id = $modelId")
                ->where('discount_packages.booking_duration', $weeksDiff)
                ->where('discount_packages.booking_duration_type','weeks')
                ->where('discount_packages.status',true)
                ->first();
        }else if($daysDiff==0 && $weeksDiff==0 && $monthsDiff>0){
            $oDiscount = DiscountVolume::Join('discount_package_periods', 'discount_packages.id', '=', 'discount_package_periods.discount_package_id')
                ->Join('discount_package_models', 'discount_packages.id', '=', 'discount_package_models.discount_package_id')
                ->whereRaw('DATE_FORMAT(start_date,\'%Y-%m-%d\') <= "'.Carbon::now()->format('Y-m-d').'"')
                ->whereRaw('DATE_FORMAT(end_date,\'%Y-%m-%d\') >= "'.Carbon::now()->format('Y-m-d').'"')
                ->whereRaw("discount_package_models.model_id = $modelId")
                ->where('discount_packages.booking_duration', $monthsDiff)
                ->where('discount_packages.booking_duration_type','months')
                ->where('discount_packages.status',true)
                ->first();
        }*/
        if(!$oDiscount){
            return false;
        }

        return ['amount' => $oDiscount->discount_amount, 'amount_type' => $oDiscount->discount_type];
    }
    
    public function formatCurrencySign($price, $currency, $separator = " ")
    {
        switch ($currency)
        {
            case 'USD':
                $format = "$" . $separator . $price;
                break;
            case 'GBP':
                $format = "&pound;" . $separator . $price;
                break;
            case 'EUR':
                $format = "&euro;" . $separator . $price;
                break;
            case 'JPY':
                $format = "&yen;" . $separator . $price;
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
                $format = $price . $separator . $currency;
                break;
            case 'NOK':
            case 'HUF':
            case 'CZK':
            case 'ILS':
            case 'MXN':
                $format = $currency . $separator . $price;
                break;
            default:
                $format = $price . $separator . $currency;
                break;
        }
        return $format;
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

    public function calculateDateDiff($start , $end){
        $from = Carbon::parse($start);
        $to = Carbon::parse($end);
        $datetime1 = new \DateTime($to); // Today's Date/Time
        $datetime2 = new \DateTime($from);
        $interval = $datetime1->diff($datetime2);
        $data['days'] = $interval->days;
        $data['hours'] = $interval->format('%H');
        $data['info'] = $interval;
        return $data;
    }
    
    public function uploadFile(Request $request){
//        $oUser = User::where('id', $request->input('user'))->first();
//        if(!$oUser){
//            return $this->_failedJsonResponse([['User record is not valid.']]);
//        }
        if ($request->file('passport')) {
//            $oUser->passport_id = $request->file('passport')->store('public/users');
            $data['file'] = $request->file('passport')->store('public/users');
            $data['type'] = 'passport';
//            $oUser->save();
        }
        if ($request->file('licence')) {
//            $oUser->driver_licence = $request->file('licence')->store('public/users');
            $data['file'] = $request->file('licence')->store('public/users');
            $data['type'] = 'licence';
//            $oUser->save();
        }
        if ($request->file('rental_form')) {
//            $oUser->rental_form = $request->file('rental_form')->store('public/users');
            $data['file'] = $request->file('rental_form')->store('public/users');
            $data['type'] = 'rental_form';
//            $oUser->save();
        }
        return $this->_successJsonResponse(['message'=>'File is Uploaded.', 'data'=>$data]);
    }

    public function invoicePDF($id){

        $oReservation = CarReservation::where('id',$id)->first();
        if(!$oReservation){
            return $this->_failedJsonResponse([['Reservation is not valid or has been removed.']]);
        }

        $currency = $this->getCurrencySign($this->option_arr['currency']);
//        return view('admin.reservations.invoice.invoice', compact('oReservation', 'currency'));
//        $html = \View::make('admin.reservations.invoice.invoice', compact('oReservation', 'currency'));
//        $content = $html->render();
//        PDF::AddPage('p', 'A4');
//        PDF::SetFont('dejavusans', '', 10);
//        PDF::SetAutoPageBreak(TRUE, 0);
//        PDF::SetMargins(0, 0, 0);
//        PDF::writeHTML($content, true, 0, true, true);
//        PDF::lastPage();
//        PDF::Output('example_006.pdf', 'I');
        $pdf = PDF::loadView('admin.reservations.invoice.invoice', compact('oReservation', 'currency'));
        return $pdf->download($oReservation->reservation_number.'.pdf');
    }
    
    public function checkCarAvailability(Request $request){
            $response = array('code' => 100);

            $date_from =Carbon::parse($request->input('date_from'));
            $date_to =Carbon::parse($request->input('date_to'));

            $date_from_ts = strtotime($date_from);
            $date_to_ts = strtotime($date_to);

            if($date_to_ts <= $date_from_ts){
                $response = array('code' => 100);
            }else{
                if ((int) $request->input('models') > 0 && (int) $request->input('car_id') > 0 ){
                    $min_hour = $this->option_arr['minimum_booking_length'];
                    if($this->option_arr['calculate_rental_fee'] == 'perday'){
                        $min_hour = $this->option_arr['minimum_booking_length'] * 24;
                    }
                    if( round($date_to_ts - $date_from_ts)/3600 < $min_hour){
                        $response['code'] = 100;
                        return $response;
                    }

                    $current_datetime = date('Y-m-d H:i:s', time() - ($this->option_arr['booking_pending'] * 3600));
//                    $oBooking = CarReservation::with('details')->where('car_reservation_details.car_type_id', $request->input('car_type_id'))
                    if (($request->input('id')) && (int) $request->input('id')){
                        $id = $request->input('id');
                    }else{
                        $id = 0;
                    }
                    $oBooking = CarReservation::Join('car_reservation_details', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
                                ->where('car_reservation_details.car_model_id', $request->input('models'))
                                ->where('car_reservation_details.car_id', $request->input('car_id'))
                                ->where('rental_car_reservations.id','<>', $id)
                                ->whereRaw("(`status` = 'confirmed' OR (`status` = 'pending' AND rental_car_reservations.created_at >= '$current_datetime'))")
                                ->whereRaw(sprintf("(((`date_from` BETWEEN '%1\$s' AND '%2\$s') OR (`date_to` BETWEEN '%1\$s' AND '%2\$s')) OR (`date_from` < '%1\$s' AND `date_to` > '%2\$s') OR (`date_from` > '%1\$s' AND `date_to` < '%2\$s'))",$date_from, $date_to))
                                ->distinct('rental_car_reservations.id')
//                                ->toSql();
                                ->count('rental_car_reservations.id');
                    
                    $booking_cnt = $oBooking;//$pjBookingModel->findCount()->getData();
                    if ($booking_cnt == 0){
                        $response['code'] = 200;
                    }else{
                        $response['code'] = 150;
                    }
                }else{
                    $response['code'] = 300;
                }
            }
            return $response;
    }

    public function getDiscountInfo(Request $request){
        if($request->input('discount_code')==''){
            return false;
        }

        if($request->input('date_from')=='' || $request->input('date_to')==''){
            return false;
        }
        $oDiscount = Discount::where('voucher_code', $request->input('discount_code'))->first();
        if(!$oDiscount){
            return false;
        }

        if($oDiscount->discount_type=='selected' && $request->input('car_id')==''){
            return false;
        }

        if($oDiscount->discount_type=='selected') {
            $oDiscountCar = $oDiscount->carModels()->where('model_id', $request->input('models'))->first();
            if(!$oDiscountCar){
                return false;
            }
        }

        $oInfo = $oDiscount->recurring->repititions()
                    ->whereRaw('DATE_FORMAT(start_repeat,\'%Y-%m-%d\') <= "'.Carbon::parse($request->input('date_from'))->format('Y-m-d').'"')
                    ->whereRaw('DATE_FORMAT(end_repeat,\'%Y-%m-%d\') >= "'.Carbon::parse($request->input('date_from'))->format('Y-m-d').'"')
                    ->first();
        if(!$oInfo){
            return false;
        }

        return ['amount' => $oDiscount->amount, 'amount_type' => $oDiscount->amount_type];

    }
    public function validateVoucher(Request $request){
        $this->_checkAjaxRequest();

        if($request->input('discount_code')==''){
            return $this->_failedJsonResponse([['Please mention Discount Voucher Code.']]);
        }

        if($request->input('date_from')=='' || $request->input('date_to')==''){
            return $this->_failedJsonResponse([['Please define Reservation Dates.']]);
        }
        $oDiscount = Discount::where('voucher_code', $request->input('discount_code'))->first();
        if(!$oDiscount){
            return $this->_failedJsonResponse([['Discount Voucher Code is not valid.']]);
        }

        if($oDiscount->discount_type=='selected' && $request->input('models')==''){
            return $this->_failedJsonResponse([['Please select Car Make & Model.']]);
        }

        if($oDiscount->discount_type=='selected') {
            $oDiscountCar = $oDiscount->carModels()->where('model_id', $request->input('models'))->first();
            if(!$oDiscountCar){
                return $this->_failedJsonResponse([['Discount Voucher is not valid for selected Car.']]);
            }
        }

        $oInfo = $oDiscount->recurring->repititions()
                ->whereRaw('DATE_FORMAT(start_repeat,\'%Y-%m-%d\') <= "'.Carbon::parse($request->input('date_from'))->format('Y-m-d').'"')
                ->whereRaw('DATE_FORMAT(end_repeat,\'%Y-%m-%d\') >= "'.Carbon::parse($request->input('date_from'))->format('Y-m-d').'"')                
                ->first();
        if(!$oInfo){
            return $this->_failedJsonResponse([['Discount Voucher is not valid for selected Duration.']]);
        }

        $data['voucher'] = $oDiscount;
        return $this->_successJsonResponse(['message'=>'Discount Voucher Code is valid.', 'data' => $data]);
    }
    
    public function loadInformation(Request $request)
    {
        $this->_checkAjaxRequest();
        if($request->input('id')==''){
            return $this->_failedJsonResponse([['Reservation Id is not valid or has been removed.']]);
        }
        
        $oReservation = CarReservation::where('id',$request->input('id'))->first();
        if(!$oReservation){
            return $this->_failedJsonResponse([['Reservation is not valid or has been removed.']]);
        }
        
        return $this->_successJsonResponse(['message'=>'Reservation is valid.', 'data' => $oReservation]);
    }
    
    public function updateInformation(Request $request)
    {
        $this->_checkAjaxRequest();
        if($request->input('id')==''){
            return $this->_failedJsonResponse([['Reservation Id is not valid or has been removed.']]);
        }
        
        $oReservation = CarReservation::where('id',$request->input('id'))->first();
        if(!$oReservation){
            return $this->_failedJsonResponse([['Reservation is not valid or has been removed.']]);
        }
        $oReservation->status = $request->input('status');
        $oReservation->save();
        
        return $this->_successJsonResponse(['message'=>'Reservation is valid.', 'data' => $oReservation]);
    }
    
    private function _sendReservationEmail($oReservation){
        if(!$oReservation){
            return $this->_failedJsonResponse([['Reservation is not valid or has been removed.']]);
        }

        $toNotifiers = explode(",", $this->option_arr['reservations_notify']);
        $toEmails = [];
        foreach ($toNotifiers as $toNotifier){
            $toInfo = explode(":", $toNotifier);
            $toEmails[] = ['name' =>$toInfo[0], 'email' => $toInfo[1]];
        }
        
        $currency = $this->getCurrencySign($this->option_arr['currency']);
        $pdf = PDF::loadView('emails.reservation.pdf', compact('oReservation', 'currency'))->save(storage_path('emails/'.$oReservation->reservation_number.'.pdf'));
        
        $view = \View::make('emails.reservation.notification', compact('oReservation', 'currency'));
        $contents = $view->render();

        $email = array(
            'html' => $contents,
            'text' => 'New Car Reservation#'.$oReservation->reservation_number,
            'subject' => 'New Car Reservation#'.$oReservation->reservation_number,
            'from' => array(
                'name' => 'suzanne',
                'email' => 'suzanne@embassyalliance.com'
            ),
            'to' => $toEmails,
            'attachments' => array(
                'invoice.pdf' => file_get_contents(str_replace('public/', 'storage/', storage_path('emails/'.$oReservation->reservation_number.'.pdf')))
            )
        );
        SendPulse::smtpSendMail($email);        
    }
}