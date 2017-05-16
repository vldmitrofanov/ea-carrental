<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Setting;
use Session;
use Carbon\Carbon;
use App\CarReservation;
use App\CarExtra;
use App\DiscountVolume;

class RentalCar extends Model
{
    protected $table = 'rental_cars';
    
    protected $option_arr = array();
    public function __construct()
    {
        $oSettings = Setting::get();
        foreach ($oSettings as $oSetting){
            $this->option_arr[$oSetting->key] = $oSetting->value;
        }
    }
    
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
    
    private function _checkCarAvailability($oRentalCar, $makeAndModel){
//        $oRentalCar = $this;
        $response = array('code' => 100);
        $cartData = Session::get('search');
        $date_from =Carbon::parse($cartData->start);
        $date_to =Carbon::parse($cartData->end);

        $date_from_ts = strtotime($date_from);
        $date_to_ts = strtotime($date_to);
        if($date_to_ts <= $date_from_ts){
            $response = array('code' => 100);
        }else{
            if ((int) $makeAndModel->id > 0 && (int) $oRentalCar->id > 0 ){
                $min_hour = $this->option_arr['minimum_booking_length'];
                if($this->option_arr['calculate_rental_fee'] == 'perday'){
                    $min_hour = $this->option_arr['minimum_booking_length'] * 24;
                }
                if( round($date_to_ts - $date_from_ts)/3600 < $min_hour){
                    $response['code'] = 100;
                    return $response;
                }

                $current_datetime = date('Y-m-d H:i:s', time() - ($this->option_arr['booking_pending'] * 3600));
                $oBooking = CarReservation::Join('car_reservation_details', 'rental_car_reservations.id', '=', 'car_reservation_details.reservation_id')
                    ->where('car_reservation_details.car_model_id', $makeAndModel->id)
                    ->where('car_reservation_details.car_id', $oRentalCar->id)
//                    ->whereRaw("(`status` = 'confirmed' OR (`status` = 'pending' AND rental_car_reservations.created_at >= '$current_datetime'))")
                    ->whereRaw(sprintf("!(((`date_from` BETWEEN '%1\$s' AND '%2\$s') OR (`date_to` BETWEEN '%1\$s' AND '%2\$s')) OR (`date_from` < '%1\$s' AND `date_to` > '%2\$s') OR (`date_from` > '%1\$s' AND `date_to` < '%2\$s'))",$date_from, $date_to))
                    ->distinct('rental_car_reservations.id')
//                    ->toSql();
                    ->count('rental_car_reservations.id');
//        dd($oBooking);exit;
                $booking_cnt = $oBooking;
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
    
    public function getCarPrice(){
        $cartData = Session::get('search');
        $o_new_day_per_day =0 ;
        $oSetting = Setting::where('key', 'currency')->first();
        $currency = ($oSetting)?$oSetting->value:'USD';

        $data['time'] = $this->_calculateDateDiff($cartData->start, $cartData->end);
        $oRentalCar = $this;
        $oCarModel = $oRentalCar->makeAndModel;
        if(!$oCarModel){
            return $this->_failedJsonResponse([['Car Model is not valid or has been removed.']]);
        }
        
        $oCarType = $oCarModel->SIPPCode;
        if(!$oCarType){
            return $this->_failedJsonResponse([['Car Type is not valid or has been removed.']]);
        }

        $carAvailable = $this->_checkCarAvailability($oRentalCar, $oRentalCar->makeAndModel);
        if($carAvailable['code']==100){
            return $this->_failedJsonResponse([['Reservation date range is not valid.']]);
        }else if($carAvailable['code']==300){
            return $this->_failedJsonResponse([['Car Type and Car is not valid.']]);
        }else if($carAvailable['code']==150){
            return $this->_failedJsonResponse([['Car is <strong>not available</strong> during selected time period. Please select another Car and/or change time period.']]);
        }

        $oPrices = $oCarModel->prices()
            ->where('car_model_prices.date_from','>=',Carbon::parse($cartData->start)->format('Y-m-d'))
            ->where('car_model_prices.date_to','<=',Carbon::parse($cartData->end)->format('Y-m-d'))
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
        $discount = 0;
        $discount_detail = '';
        $discount_information = '';

        $car_rental_fee_arr = array();
        $e_arr = array();
        $extra_arr = array();
        $extra_qty_arr = array();
        

        if(count($e_arr) > 0){
            $extra_arr = CarExtra::whereIn('id', $e_arr)->get();
        }
        $real_rental_days = $this->_getRealRentalDays(Carbon::parse($cartData->start), Carbon::parse($cartData->end));
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


        $price_arr = $this->_getPrices(Carbon::parse($cartData->start), Carbon::parse($cartData->end), $oCarModel);
        if($price_arr['price'] == 0)
        {
            $price_arr = $this->_getDefaultPrices(Carbon::parse($cartData->start), Carbon::parse($cartData->end), $oCarModel);
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
        switch ($this->option_arr['deposit_type'])
        {
            case 'percent':
                $required_deposit = ($total_price * $this->option_arr['deposit_payment']) / 100;
                $required_deposit_detail = $this->option_arr['deposit_payment'] . '% of '. $this->formatCurrencySign($total_price, $this->option_arr['currency']);
                break;
            case 'amount':
                $required_deposit = $this->option_arr['deposit_payment'];
                $required_deposit_detail = '';
                break;
        }
        
        $discount_info = false;
//        if($request->input('discount_code')){
        $discount_info = $this->_getDiscountInfo($cartData->start, $cartData->end, $oCarModel->id);
//        }
            
        if(is_array($discount_info)){
            switch ($discount_info['amount_type']){
                case 'percent':
                    $discount = ($total_price * $discount_info['amount']) / 100;
                    $discount_detail = $discount_info['amount'] . '% of '. $this->formatCurrencySign($total_price, $this->option_arr['currency']);
                     $discount_information = $discount_info['amount'] . '% off';
                    break;
                case 'amount':
                    $discount = $discount_info['amount'];
                    $discount_detail = '';
                    $discount_information = $discount_info['amount'].$this->option_arr['currency'] . ' off';
                    break;
            }
        }
        
        $total_price_original = $total_price;
                
        $total_price = $total_price - $discount;

        $total_amount_due = $total_price;
//        if($request->input('status') == 'confirmed'){
//            $total_amount_due = $total_price - $required_deposit;
//        }


        $price_per_day = number_format($price_per_day, 2, '.', '');
        $price_per_hour = number_format($price_per_hour, 2, '.', '');
        $car_rental_fee = number_format($car_rental_fee, 2, '.', '');
        $extra_price = number_format($extra_price, 2, '.', '');
        $discount = number_format($discount, 2, '.', '');
        $insurance = number_format($insurance, 2, '.', '');
        $sub_total = number_format($sub_total, 2, '.', '');
        $tax = number_format($tax, 2, '.', '');
        $total_price = number_format($total_price, 2, '.', '');
        $total_price_original = number_format($total_price_original, 2, '.', '');
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
        $data = compact('total_price_original','rental_time', 'rental_days', 'hours',
            'price_per_day', 'price_per_hour', 'price_per_day_detail', 'price_per_hour_detail',
            'car_rental_fee', 'extra_price', 'discount', 'insurance', 'sub_total', 'tax',
            'total_price', 'required_deposit', 'total_amount_due',
            'price_per_day_label', 'price_per_hour_label', 'car_rental_fee_label',
            'extra_price_label', 'insurance_label', 'sub_total_label', 'tax_label',
            'total_price_label', 'required_deposit_label', 'total_amount_due_label', 'discount_label',
            'car_rental_fee_detail', 'insurance_detail', 'discount_detail', 'discount_information', 'tax_detail', 'required_deposit_detail');
        
//        $data['prices'] = compact('rental_time', 'rental_days', 'hours',
//            'price_per_day', 'price_per_hour', 'price_per_day_detail', 'price_per_hour_detail',
//            'car_rental_fee', 'extra_price', 'discount', 'insurance', 'sub_total', 'tax',
//            'total_price', 'required_deposit', 'total_amount_due',
//            'price_per_day_label', 'price_per_hour_label', 'car_rental_fee_label',
//            'extra_price_label', 'insurance_label', 'sub_total_label', 'tax_label',
//            'total_price_label', 'required_deposit_label', 'total_amount_due_label', 'discount_label',
//            'car_rental_fee_detail', 'insurance_detail', 'discount_detail', 'tax_detail', 'required_deposit_detail');

//        $oCar = $oCarModel->cars()->where('rental_cars.id', $request->input('car_id'))->first();

//        $data['type'] = $oCarType;
//        $data['model'] = $oCarModel;
//        $data['car'] = $oRentalCar;
//        $data['extra_arr'] = $extra_arr;
//        $data['currency'] = $currency;
//        $data['currencySign'] = $this->getCurrencySign($currency);
        
        return $data;
    }
    
    private function _getDiscountInfo($start, $end, $modelId){

        $oDiscount = DiscountVolume::Join('discount_package_periods', 'discount_packages.id', '=', 'discount_package_periods.discount_package_id')
                ->Join('discount_package_models', 'discount_packages.id', '=', 'discount_package_models.discount_package_id')
                ->whereRaw('DATE_FORMAT(start_date,\'%Y-%m-%d\') >= "'.Carbon::parse($start)->format('Y-m-d').'"')
                ->whereRaw('DATE_FORMAT(end_date,\'%Y-%m-%d\') <= "'.Carbon::parse($end)->format('Y-m-d').'"')
//                ->whereRaw('discount_voucher_recurring_rules.frequency = "weekly"')
                ->whereRaw("discount_package_models.model_id = $modelId")
                ->first();
                
        if(!$oDiscount){
            return false;
        }

        return ['amount' => $oDiscount->discount_amount, 'amount_type' => $oDiscount->discount_type];

    }
    
    private function _getDefaultPrices($datetime_from, $datetime_to, $oCarModel)
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
    
    private function _getPrices($datetime_from, $datetime_to, $oCarModel)
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
    
    private function _getRealRentalDays($datetime_from, $datetime_to)
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
}
