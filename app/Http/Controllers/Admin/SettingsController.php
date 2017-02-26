<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Country;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oSettings = Setting::get();
        $oCurrencies = Country::where('currency_name', '<>', '')->get();
        return view('admin.settings.index', compact('oSettings', 'oCurrencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        print_r($request->all());exit;
        foreach($request->input('data') as $key=>$value){
//            echo $key.'**'.$value.'<br/>';
            $oSetting = Setting::where('key', $key)->first();
            if(!$oSetting){
                $oSetting = new Setting;
            }
            $oSetting->key = $key;
            $oSetting->value = $value;
            $oSetting->save();
        }

        \Session::flash('flash_message', 'Settings saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/settings');
    }

}
