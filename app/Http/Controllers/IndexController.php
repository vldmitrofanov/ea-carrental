<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RentalCar;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oFeaturedCars = RentalCar::where('featured', true)->take(3)->get();
        return view('welcome', compact('oFeaturedCars'));
    }
}
