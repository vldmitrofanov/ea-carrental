<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CarReservation;
use MaddHatter\LaravelFullcalendar\Event;
use Carbon\Carbon;
use App\Setting;
use App\RentalCar;

class FleetAvailabilityController extends Controller
{
    protected $option_arr = array();
    public function __construct()
    {
        $oSettings = Setting::get();
        foreach ($oSettings as $oSetting){
            $this->option_arr[$oSetting->key] = $oSetting->value;
        }
    }

    public function index()
    {
        $currencySign = $this->getCurrencySign($this->option_arr['currency']);

        $carsArr = [];
        $oCars = RentalCar::all();
        foreach($oCars as $oCar){
            $carsArr[] = ["id" => $oCar->id, "title" => $oCar->registration_number];
        }
        $cars = json_encode($carsArr);

        $oReservations = CarReservation::whereIn('status', ['pending','confirmed'])->get();
        $reservationsArr = [];
        foreach($oReservations as $oReservation){
            $reservationsArr[] = [
                                'id' => $oReservation->id,
                                'resourceId' => $oReservation->details->first()->car->id,
                                'start' => $oReservation->details->first()->date_from,
                                'end' => $oReservation->details->first()->date_to,
                                'title' => $oReservation->user->name.'( '.$oReservation->user->phone.' )',
                            ];
        }

        $reservations = json_encode($reservationsArr);
/*
        $events = [];
        $oReservations = CarReservation::paginate(100);
        foreach ($oReservations as $oReservation){
            $detail = '<b>Customer</b>: '.$oReservation->user->name;
            $detail .= '<br><b>Contact No</b>: '.$oReservation->user->phone;
            $detail .= '<br><b>Pick-up Location</b>: '.$oReservation->details->first()->pickup->name;
            $detail .= '<br><b>Return Location</b>: '.$oReservation->details->first()->returnLocation->name;
            $detail .= '<br><b>Total Price</b>: '.$currencySign.$oReservation->details()->sum('total_price');
            $detail .= '<br><b>Status</b>: '.$oReservation->status;

            $events[] = \Calendar::event(
                $oReservation->details->first()->car->registration_number.' ('.$oReservation->details->first()->model->make.' - '.$oReservation->details->first()->model->model.')', //event title
                false, //full day event?
                $oReservation->details->first()->date_from, //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
                $oReservation->details->first()->date_to, //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
                $oReservation->id, //optional event ID
                [
                    'url' => url('admin/reservations/'.$oReservation->id.'/edit'),
                    'description' => $detail,
                ]
            );
        }

        $eloquentEvent = CarReservation::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event
        $calendar = \Calendar::addEvents($events) //add an array with addEvents
        /*->addEvent($eloquentEvent, [ //set custom color fo this event
            'color' => '#800',
        ])//->setOptions([ //set fullcalendar options
            'defaultView' => 'timelineDay',
        ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
//            'eventMouseover' => 'function(data, event, view) {
//                tooltip = \'<div class="tooltiptopicevent" style="width:auto;height:auto;background:#3c8dbc;color:#fff;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">\' + \'title: \' + \': \' + data.title + \'</br>\' + \'start: \' + \': \' + data.start + \'</div>\';
//                $("body").append(tooltip);
//                $(this).mouseover(function (e) {
//                    $(this).css(\'z-index\', 10000);
//                    $(\'.tooltiptopicevent\').fadeIn(\'500\');
//                    $(\'.tooltiptopicevent\').fadeTo(\'10\', 1.9);
//                }).mousemove(function (e) {
//                    $(\'.tooltiptopicevent\').css(\'top\', e.pageY + 10);
//                    $(\'.tooltiptopicevent\').css(\'left\', e.pageX + 20);
//                });
//            }',
            'eventRender' => 'function (event, element) {
                element.attr(\'href\', \'javascript:void(0);\');
                element.click(function() {
                    $("#eventTitle").html(event.title);
                    $("#startTime").html(moment(event.start).format(\'MMM Do h:mm A\'));
                    $("#endTime").html(moment(event.end).format(\'MMM Do h:mm A\'));
                    $("#eventInfo").html(event.description);
                    $("#eventLink").attr(\'href\', event.url);
                    $("#modal-success").modal("show");
                });
            }',
        ]);*/
        return view('admin.fleetavailabilty.index', compact('currencySign','cars','reservations'));
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
