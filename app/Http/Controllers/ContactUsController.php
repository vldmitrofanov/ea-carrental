<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactUsRequest;
use Session;
use \SendPulse;
use App\Setting;

class ContactUsController extends Controller
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
        return view('frontend.contact_us.index');
    }

    public function contact(){
        return view('frontend.contact_us.form');
    }

    public function sendContactEmail(ContactUsRequest $request){
        $view = \View::make('emails.contact_us.notification', compact('request'));
        $contents = $view->render();
        $toNotifiers = explode(",", $this->option_arr['contact_us_notify']);
        $toEmails = [];
        foreach ($toNotifiers as $toNotifier){
            $toInfo = explode(":", $toNotifier);
            $toEmails[] = ['name' =>$toInfo[0], 'email' => $toInfo[1]];
        }

        $email = array(
            'html' => $contents,
            'text' => 'Embassy Alliance Contact Us',
            'subject' => 'Embassy Alliance Contact Us',
            'from' => array(
                'name' => 'suzanne',
                'email' => 'suzanne@embassyalliance.com'
            ),
            'to' => $toEmails
        );
        SendPulse::smtpSendMail($email);

        \Session::flash('flash_message', 'You message has been delivered. Soon we will contact you.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('contact-us');
    }
}
