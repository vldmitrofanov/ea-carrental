<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RentalCar;
use App\CarType;
use App\OfficeLocation;
use App\Http\Requests\RentalCarRequest;

class RentalCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->input('q'))) {
//            $oSchedules = Schedule::orderby('start_at','asc')->where('tournament_id',$request->input('q'))->paginate(15);
            $oRentalCars = RentalCar::Join('rental_car_types', 'rental_cars.id', '=', 'rental_car_types.car_id')
                            ->where('rental_car_types.car_type_id', $request->input('q'))
                            ->paginate(15);
        }else{
            $oRentalCars = RentalCar::paginate(15);
        }
        
        $oCarTypes = CarType::get();
        return view('admin.rental_cars.index', compact('oRentalCars', 'oCarTypes'))->with('q', $request->input('q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oRentalCar = null;
        $oCarTypes = CarType::pluck('name', 'id')->toArray();
        $oOfficeLocations = OfficeLocation::pluck('name', 'id')->toArray();
        return view('admin.rental_cars.add', compact('oRentalCar', 'oCarTypes', 'oOfficeLocations'));
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
        $oRentalCar->make = $request->input('make');
        $oRentalCar->model = $request->input('model');
        $oRentalCar->registration_number = $request->input('registration_number');
        $oRentalCar->current_mileage = $request->input('current_mileage');
        $oRentalCar->location_id = $request->input('location_id');
        if($oRentalCar->save()){
            if(is_array($request->input('car_types'))) {
                $oRentalCar->types()->sync($request->input('car_types'));
            }else{
                $oRentalCar->types()->sync([]);
            }
        }

        \Session::flash('flash_message', 'Car Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/cars');
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
        $oCarTypes = CarType::pluck('name', 'id')->toArray();
        $oOfficeLocations = OfficeLocation::pluck('name', 'id')->toArray();
        return view('admin.rental_cars.edit', compact('oRentalCar', 'oCarTypes', 'oOfficeLocations'));
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
        $oRentalCar->make = $request->input('make');
        $oRentalCar->model = $request->input('model');
        $oRentalCar->registration_number = $request->input('registration_number');
        $oRentalCar->current_mileage = $request->input('current_mileage');
        $oRentalCar->location_id = $request->input('location_id');
        $oRentalCar->save();

        if(is_array($request->input('car_types'))) {
            $oRentalCar->types()->sync($request->input('car_types'));
        }else{
            $oRentalCar->types()->sync([]);
        }

        \Session::flash('flash_message', 'Rental Car Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/cars');
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

}
