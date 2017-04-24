<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FleetAvailabilityController extends Controller
{
    public function index()
    {
        return view('admin.fleetavailabilty.index');
    }
}
