<?php

namespace App\Http\Controllers\Admin\FleetManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RentalCar;
use App\Types;
use App\OfficeLocation;
use App\Http\Requests\RentalCarRequest;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->input('q'))) {
            $oRentalCars = RentalCar::where('rental_car_types.car_type_id', $request->input('q'))
                            ->paginate(15);
        }else{
            $oRentalCars = RentalCar::paginate(15);
        }

        $oTypes = Types::get();
        return view('admin.fleet_management.cars.index', compact('oRentalCars', 'oTypes'))->with('q', $request->input('q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oRentalCar = null;
        $oTypes = Types::get();
        $oOfficeLocations = OfficeLocation::pluck('name', 'id')->toArray();
        return view('admin.fleet_management.cars.add', compact('oRentalCar', 'oTypes', 'oOfficeLocations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RentalCarRequest $request)
    {
        $oRentalCar = new RentalCar;
        $oRentalCar->model_id = $request->input('model_id');
        $oRentalCar->type_id = $request->input('type_id');
        $oRentalCar->registration_number = $request->input('registration_number');
        $oRentalCar->current_mileage = $request->input('current_mileage');
        $oRentalCar->location_id = $request->input('location_id');
        $oRentalCar->save();
        if($request->file('thumb_image')){
            $oRentalCar->thumb_image = $request->file('thumb_image')->store('/public/uploads/cars');
            $oRentalCar->save();
        }

        \Session::flash('flash_message', 'Car Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/fleet/cars');
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
        $oRentalCar = RentalCar::where('id', $id)->firstOrFail();
        $oTypes = Types::get();
        $oOfficeLocations = OfficeLocation::pluck('name', 'id')->toArray();
        return view('admin.fleet_management.cars.edit', compact('oRentalCar', 'oTypes', 'oOfficeLocations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RentalCarRequest $request, $id)
    {
        $oRentalCar = RentalCar::findOrFail($id);
        $oRentalCar->model_id = $request->input('model_id');
        $oRentalCar->type_id = $request->input('type_id');
        $oRentalCar->registration_number = $request->input('registration_number');
        $oRentalCar->current_mileage = $request->input('current_mileage');
        $oRentalCar->location_id = $request->input('location_id');
        $oRentalCar->save();
        if($request->file('thumb_image')){
            $oRentalCar->thumb_image = $request->file('thumb_image')->store('/public/uploads/cars');
            $oRentalCar->save();
        }

        \Session::flash('flash_message', 'Rental Car Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/fleet/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oRentalCar = RentalCar::where('id',$id)->first();
        if(!$oRentalCar){
            \Session::flash('flash_message', 'Rental Car is not valid or has been removed.');
            \Session::flash('flash_type', 'alert-error');
            return \Redirect::to('admin/cars');
        }

        $oRentalCar->delete();
        \Session::flash('flash_message', 'Rental Car has been removed.');
        \Session::flash('flash_type', 'alert-success');
        return \Redirect::to('admin/cars');
    }

    /**
     * Function to mark car as featured and vice versa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function featured($id){
        $this->_checkAjaxRequest();

        $oCar = RentalCar::where('id', $id)->first();
        if(!$oCar){
            return $this->_failedJsonResponse([['Car is not valid or has been removed.']]);
        }

        $oCar->featured = !$oCar->featured;
        $oCar->save();
        return $this->_successJsonResponse(['message'=>'Car information is updated.', 'data' => $oCar]);
    }

    /**
     * Function to mark car as featured and vice versa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id){
        $this->_checkAjaxRequest();

        $oCar = RentalCar::where('id', $id)->first();
        if(!$oCar){
            return $this->_failedJsonResponse([['Car is not valid or has been removed.']]);
        }

        $oCar->status = !$oCar->status;
        $oCar->save();
        return $this->_successJsonResponse(['message'=>'Car information is updated.', 'data' => $oCar]);
    }
}
