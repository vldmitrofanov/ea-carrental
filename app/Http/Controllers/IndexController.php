<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RentalCar;
use App\DiscountFreebies;
use App\CarReservation;
use App\CarReservationExtra;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oFeaturedCars = RentalCar::where('featured', true)->take(4)->get();
        return view('welcome', compact('oFeaturedCars'));
    }
    
    public function dashboard(){
        $oReservations = CarReservation::where('user_id', \Auth::user()->id)->orderby('processed_on', 'DESC');
        return view('frontend.dashboard.index', compact('oReservations'));
    }
}
