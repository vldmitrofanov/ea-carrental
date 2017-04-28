<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class UsersController extends Controller
{
    public function getLogin(){
        return view('frontend.auth.login');
    }

    public function getRegistration(){
        $oCountries = Country::pluck('name', 'id')->toArray();

        return view('frontend.auth.register', compact('oCountries'));
    }
}
