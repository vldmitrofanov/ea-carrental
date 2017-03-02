<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\RentalCarReservation;
use App\OfficeLocation;
use App\CarType;
use App\Country;
use App\Setting;

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
        $oReservations = RentalCarReservation::paginate(15);
        return view('admin.reservations.index', compact('oReservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oOfficeLocations = OfficeLocation::pluck('name', 'id')->toArray();
        $oCarTypes = CarType::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $oCountries = Country::pluck('name', 'id')->toArray();
        return view('admin.reservations.add', compact('oOfficeLocations', 'oCarTypes', 'oCountries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $oUser = new User;
        $oUser->name = $request->input('name');
        $oUser->username = $request->input('username');
        $oUser->email = $request->input('email');
        $oUser->phone = $request->input('phone');
        $oUser->password = bcrypt($request->input('password'));
        $oUser->status = (boolean)$request->input('status');

        if($oUser->save()){
            $oUser->roles()->attach($request->input('role_id'));
        }

        \Session::flash('flash_message', 'User Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/users');
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
        $oUser = User::where('id', $id)->firstOrFail();
        $oRoles = Role::orderBy('name', 'ASC')->get();
        return view('admin.users.edit', compact('oRoles', 'oUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $oUser = User::findOrFail($id);
        $oUser->name = $request->input('name');
        $oUser->username = $request->input('username');
        $oUser->email = $request->input('email');
        $oUser->phone = $request->input('phone');
        if($request->input('password')!='') {
            $oUser->password = bcrypt($request->input('password'));
        }
        $oUser->status = (boolean)$request->input('status');
        $oUser->save();
        $oUser->detachRoles();

        $oUser->roles()->attach($request->input('role_id'));

        \Session::flash('flash_message', 'User Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oUser = User::where('id',$id)->first();
        if(!$oUser){
            \Session::flash('flash_message', 'User is not valid or has been removed.');
            \Session::flash('flash_type', 'alert-error');
            return \Redirect::to('admin/users');
        }

        $oUser->delete();
        \Session::flash('flash_message', 'User Information has been removed.');
        \Session::flash('flash_type', 'alert-success');
        return \Redirect::to('admin/users');
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


    public function getPrices($datetime_from, $datetime_to, $oCarType, $option_arr)
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
                if($o_new_day_per_day > 0 && $extra_hours > $option_arr['o_new_day_per_day']){
                    $rental_days++;
                    $day_added = 1;
                }
            }
            while ($j <= $rental_days)
            {
                $price_arr = $pjPriceModel->reset()
                    ->where('t1.type_id',$oCarType->id)
                    ->where("t1.id > 0 AND ('" . date('Y-m-d',$i) . "' BETWEEN t1.date_from AND t1.date_to ) AND price_per = 'day'")
                    ->where('("'.$rental_days.'" BETWEEN t1.from AND t1.to )')
                    ->limit(1)
                    ->findAll()->getData();

                if (count($price_arr) > 0)
                {
                    $price_arr = $price_arr[0];
                    $price += (float) $price_arr['price'];
                    $price_per_day_arr[(string) $price_arr['price']][] = $i;
                }else{
                    $price += $oCarType->price_per_day;
                    $price_per_day_arr[(string) $oCarType->price_per_day][] = $i;
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
                    $price_arr = $pjPriceModel->reset()
                        ->where('t1.type_id',$oCarType->id)
                        ->where('t1.id > 0 AND ("'.date('Y-m-d', strtotime($datetime_from) + ($j * 3600)).'" BETWEEN t1.date_from AND t1.date_to ) AND price_per = "hour"')
                        ->where('("'.$rental_hours.'" BETWEEN t1.from AND t1.to )')
                        ->limit(1)
                        ->findAll()->getData();
                    if (count($price_arr) > 0 ) {
                        $price_arr = $price_arr[0];
                        $price += (float) $price_arr['price'];
                        $price_per_hour_arr[(string) $price_arr['price']][] = $j;
                    }else{
                        $price += $oCarType->price_per_hour;
                        $price_per_hour_arr[(string) $oCarType->price_per_hour][] = $j;
                    }
                    $j++;
                }
            }
            $price_per_hour = $price;

        } elseif($this->option_arr['calculate_rental_fee']  == 'both'){
            while ($j <= $rental_days)
            {
                $price_arr = $pjPriceModel->reset()
                    ->where('t1.type_id',$oCarType->id)
                    ->where('t1.id > 0 AND ("'.date('Y-m-d',$i).'" BETWEEN t1.date_from AND t1.date_to ) AND price_per = "day"')
                    ->where('("'.$rental_days.'" BETWEEN t1.from AND t1.to )')
                    ->limit(1)
                    ->findAll()->getData();
                if (count($price_arr) > 0)
                {
                    $price_arr = $price_arr[0];
                    $price += (float) $price_arr['price'];
                    $price_per_day_arr[(string) $price_arr['price']][] = $i;
                }else{
                    $price += $oCarType->price_per_day;
                    $price_per_day_arr[(string) $oCarType->price_per_day][] = $i;
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
                    $price_arr = $pjPriceModel->reset()
                        ->where('t1.type_id',$oCarType->id)
                        ->where('t1.id > 0 AND ("'.date('Y-m-d', $_end_ts + ($j * 3600)).'" BETWEEN t1.date_from AND t1.date_to ) AND price_per = "hour"')
                        ->where('("'.$extra_hours.'" BETWEEN t1.from AND t1.to )')
                        ->limit(1)
                        ->findAll()->getData();
                    if (count($price_arr) > 0 ) {
                        $price_arr = $price_arr[0];
                        $price += (float) $price_arr['price'];
                        $price_per_hour_arr[(string) $price_arr['price']][] = $j;
                    }else{
                        $price += $oCarType->price_per_hour;
                        $price_per_hour_arr[(string) $oCarType->price_per_hour][] = $j;
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
                $_day_detail_arr[] = $number_of_days . ' ' . ($number_of_days > 1 ? __('plural_day', true, false) : __('singular_day', true, false)) . ' x ' . pjUtil::formatCurrencySign(number_format($v, 2), $option_arr['o_currency']);
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
                $_hour_detail_arr[] = $number_of_hours . ' ' . ($number_of_hours > 1 ? __('plural_hour', true, false) : __('singular_hour', true, false)) . ' x ' . pjUtil::formatCurrencySign(number_format($v, 2), $option_arr['o_currency']);
            }
            $price_per_hour_detail = join("<br/>", $_hour_detail_arr);
        }

        return array('price_per_day' => $price_per_day, 'price_per_day_detail' => $price_per_day_detail,
            'price_per_hour' => $price_per_hour, 'price_per_hour_detail' => $price_per_hour_detail,
            'price' => $price, 'day_added' => $day_added);
    }

    public function loadCarPrices(Request $request){
        $this->_checkAjaxRequest();
//        print_r($this->option_arr);exit;
        $oSetting = Setting::where('key', 'currency')->first();
        $currency = ($oSetting)?$oSetting->value:'USD';

        $data['time'] = $this->calculateDateDiff($request->input('date_from'), $request->input('date_to'));

        $oCarType = CarType::where('id',$request->input('car_type_id'))->first();
        if(!$oCarType){
            return $this->_failedJsonResponse([['Car Type is not valid or has been removed.']]);
        }

        $oPrices = $oCarType->prices()
                    ->where('car_type_prices.date_from','>=',Carbon::parse($request->input('date_from'))->format('Y-m-d'))
                    ->where('car_type_prices.date_to','<=',Carbon::parse($request->input('date_to'))->format('Y-m-d'))
                    ->get();

        $rental_days = $data['time']['days'];
        $rental_hours = $data['time']['hours'];
        $hours = intval($rental_hours - ($rental_days * 24));

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

        $car_rental_fee_arr = array();
        $e_arr = array();
        $extra_arr = array();
        $extra_qty_arr = array();

        $real_rental_days = $this->getRealRentalDays(Carbon::parse($request->input('date_from')), Carbon::parse($request->input('date_to')));

        $price_arr = $this->getPrices(Carbon::parse($request->input('date_from')), Carbon::parse($request->input('date_to')), $oCarType);

        print_r($oPrices);

        $oCar = $oCarType->cars()->where('rental_cars.id', $request->input('car_id'))->first();

        $data['type'] = $oCarType;
        $data['car'] = $oCar;
        return $this->_successJsonResponse(['message'=>'Car Type Custom Rate information saved.', 'data' => $data]);
    }

    public function calculateDateDiff($start , $end){
        $from = Carbon::parse($start);
        $to = Carbon::parse($end);
        $datetime1 = new \DateTime($to); // Today's Date/Time
        $datetime2 = new \DateTime($from);
        $interval = $datetime1->diff($datetime2);
//        echo $interval->format('%D days %H hours');
        $data['days'] = $interval->format('%D');
        $data['hours'] = $interval->format('%H');
        return $data;
    }

}
