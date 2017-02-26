<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\RentalCarReservation;
use App\OfficeLocation;
use App\CarType;
use App\Country;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oReservations = RentalCarReservation::paginate(15);
        return view('admin.reservations.index', compact('oReservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oOfficeLocations = OfficeLocation::pluck('name', 'id')->toArray();
        $oCarTypes = CarType::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
        $oCountries = Country::pluck('name', 'id')->toArray();
        return view('admin.reservations.add', compact('oOfficeLocations', 'oCarTypes', 'oCountries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $oUser = new User;
        $oUser->name = $request->input('name');
        $oUser->username = $request->input('username');
        $oUser->email = $request->input('email');
        $oUser->phone = $request->input('phone');
        $oUser->password = bcrypt($request->input('password'));
        $oUser->status = (boolean)$request->input('status');

        if($oUser->save()){
            $oUser->roles()->attach($request->input('role_id'));
        }

        \Session::flash('flash_message', 'User Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oUser = User::where('id', $id)->firstOrFail();
        $oRoles = Role::orderBy('name', 'ASC')->get();
        return view('admin.users.edit', compact('oRoles', 'oUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $oUser = User::findOrFail($id);
        $oUser->name = $request->input('name');
        $oUser->username = $request->input('username');
        $oUser->email = $request->input('email');
        $oUser->phone = $request->input('phone');
        if($request->input('password')!='') {
            $oUser->password = bcrypt($request->input('password'));
        }
        $oUser->status = (boolean)$request->input('status');
        $oUser->save();
        $oUser->detachRoles();

        $oUser->roles()->attach($request->input('role_id'));

        \Session::flash('flash_message', 'User Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oUser = User::where('id',$id)->first();
        if(!$oUser){
            \Session::flash('flash_message', 'User is not valid or has been removed.');
            \Session::flash('flash_type', 'alert-error');
            return \Redirect::to('admin/users');
        }

        $oUser->delete();
        \Session::flash('flash_message', 'User Information has been removed.');
        \Session::flash('flash_type', 'alert-success');
        return \Redirect::to('admin/users');
    }

    public function loadCarPrices(Request $request){
        $this->_checkAjaxRequest();

        $oCarType = CarType::with(['prices','extras'])->where('id',$request->input('car_type_id'))->first();
        if(!$oCarType){
            return $this->_failedJsonResponse([['Car Type is not valid or has been removed.']]);
        }
        $oCar = $oCarType->cars()->where('rental_cars.id', $request->input('car_id'))->first();

        $data['type'] = $oCarType;
        $data['car'] = $oCar;
        return $this->_successJsonResponse(['message'=>'Car Type Custom Rate information saved.', 'data' => $data]);
    }
}
