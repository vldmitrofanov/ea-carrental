<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \PDF;

class DashboardController extends Controller
{
    public function index()
    {
//        $data = array();
//        $pdf = PDF::loadView('admin.auth.login', $data);
//        return $pdf->download('invoice.pdf');
        return view('admin.dashboard.index');
    }
}
