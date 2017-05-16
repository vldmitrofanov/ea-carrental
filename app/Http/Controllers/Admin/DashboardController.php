<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \PDF;
use App\RentalCarReservation as EventModel;

class DashboardController extends Controller
{
    public function index()
    {
//        $events = [];
//
//        $events[] = \Calendar::event(
//            'Event One', //event title
//            false, //full day event?
//            '2015-02-11T0800', //start time (you can also use Carbon instead of DateTime)
//            '2015-02-12T0800', //end time (you can also use Carbon instead of DateTime)
//                0 //optionally, you can specify an event ID
//        );
//
//        $events[] = \Calendar::event(
//            "Valentine's Day", //event title
//            true, //full day event?
//            new \DateTime('2015-02-14'), //start time (you can also use Carbon instead of DateTime)
//            new \DateTime('2015-02-14'), //end time (you can also use Carbon instead of DateTime)
//                'stringEventId' //optionally, you can specify an event ID
//        );
//
//        $eloquentEvent = EventModel::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event
//
//        $calendar = \Calendar::addEvents($events) //add an array with addEvents
//            ->addEvent($eloquentEvent, [ //set custom color fo this event
//                'color' => '#800',
//            ])->setOptions([ //set fullcalendar options
//                        'firstDay' => 1
//                ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
//                'viewRender' => 'function() {alert("Callbacks!");}'
//            ]);

//        $calendar = \Calendar::addEvents($events); //add an array with addEvents
//        exit;
//        $data = array();
//        $pdf = PDF::loadView('admin.auth.login', $data);
//        return $pdf->download('invoice.pdf');
        return view('admin.dashboard.index', compact('calendar'));
    }
    
    public function api(){
        $client = new \GuzzleHttp\Client;
        $response = $client->post('http://api.atiquenagra.com/api/payment', 
                        [
                            'json' => [
                                "password" => 'atiquenagra',
                                "email" => 'medriis@gmail.com',
                                "txn_amount" => '150.55',
                                "txn_desc" => 'Rental Car Reservation',
                                "tranid" => 15,
                                    
                            ],
                        ]
                    );
        
        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK

        $body = $response->getBody();
        // Implicitly cast the body to a string and echo it
        echo $body;
//        print_r($response);
    }
}
