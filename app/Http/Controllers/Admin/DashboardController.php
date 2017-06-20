<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \PDF;
use App\RentalCarReservation as EventModel;
use App\CarReservation;
use Carbon\Carbon;
use App\Setting;
use App\User;
use App\Role;
use \SendPulse;

class DashboardController extends Controller
{
    public function index()
    {
        $oCustomers = User::whereHas('roles', function($q){$q->whereIn('name', ['customer']);})->get();
        $oUsers = User::whereHas('roles', function($q){$q->whereIn('name', ['admin','editor']);})->get();
        $oReservations = CarReservation::all();

        return view('admin.dashboard.index', compact('oCustomers','oUsers','oReservations'));
    }

    public function email(Request $request){

        $oEmails = explode(",", $request->input('emailto'));
        foreach($oEmails as $email) {
          $emails[]=   array(
                'name' => 'infor',
                'email' => $email
            );
        }
        $view = \View::make('emails.admin.quickemail', compact('request'));
        $contents = $view->render();

        $email = array(
            'html' => $contents,
            'text' =>  strip_tags($request->input('message')),
            'subject' => $request->input('subject'),
            'from' => array(
                'name' => 'suzanne',
                'email' => 'suzanne@embassyalliance.com'
            ),
            'to' => $emails
        );
        SendPulse::smtpSendMail($email);

        return $this->_successJsonResponse(['message'=>'Email sent successfully.']);
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
