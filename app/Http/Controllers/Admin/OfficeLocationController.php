<?php

namespace App\Http\Controllers\Admin;

use App\OfficeLocationCustomWorkingTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OfficeLocation;
use App\Country;
use App\OfficeLocationWorkTime;
use App\Http\Requests\OfficeLocationRequest;
use Carbon\Carbon;

class OfficeLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oOfficeLocations = OfficeLocation::paginate(15);
        $oCountries = Country::pluck('id', 'name')->toArray();
        return view('admin.office_locations.index', compact('oOfficeLocations', 'oCountries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oCountries = Country::pluck('name', 'id')->toArray();
        return view('admin.office_locations.add', compact('oCountries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeLocationRequest $request)
    {
        $oOfficeLocation = new OfficeLocation;
        $oOfficeLocation->name = $request->input('name');
        $oOfficeLocation->email = $request->input('email');
        $oOfficeLocation->state = $request->input('state');
        $oOfficeLocation->city = $request->input('city');
        $oOfficeLocation->address = $request->input('address');
        $oOfficeLocation->country_id = $request->input('country_id');
        $oOfficeLocation->zip = $request->input('zip');
        $oOfficeLocation->phone = $request->input('phone');
        $oOfficeLocation->lat = $request->input('lat');
        $oOfficeLocation->lng = $request->input('lng');
        $oOfficeLocation->notify_email = (bool)$request->input('notify_email');
        $oOfficeLocation->save();

        if($request->file('thumb_image')){
            $oOfficeLocation->thumb_path = $request->file('thumb_image')->store('/public/uploads/office_locations');
            $oOfficeLocation->save();
        }

        \Session::flash('flash_message', 'Office Location saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/locations/'.$oOfficeLocation->id.'/edit');
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
        $oOfficeLocation = OfficeLocation::where('id', $id)->firstOrFail();

        $oCountries = Country::pluck('name', 'id')->toArray();
        return view('admin.office_locations.edit', compact('oOfficeLocation', 'oCountries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeLocationRequest $request, $id)
    {
        $oOfficeLocation = OfficeLocation::findOrFail($id);
        $oOfficeLocation->name = $request->input('name');
        $oOfficeLocation->email = $request->input('email');
        $oOfficeLocation->state = $request->input('state');
        $oOfficeLocation->city = $request->input('city');
        $oOfficeLocation->address = $request->input('address');
        $oOfficeLocation->country_id = $request->input('country_id');
        $oOfficeLocation->zip = $request->input('zip');
        $oOfficeLocation->phone = $request->input('phone');
        $oOfficeLocation->lat = $request->input('lat');
        $oOfficeLocation->lng = $request->input('lng');
        $oOfficeLocation->notify_email = (bool)$request->input('notify_email');
        $oOfficeLocation->save();

        if($request->file('thumb_image')){
            $oOfficeLocation->thumb_path = $request->file('thumb_image')->store('/public/uploads/office_locations');
            $oOfficeLocation->save();
        }

        $oWorkingTime = $oOfficeLocation->workingTime;
        if(!$oWorkingTime){
            $oWorkingTime = new OfficeLocationWorkTime;
            $oWorkingTime->location_id = $oOfficeLocation->id;
        }
        $oWorkingTime->monday_from = Carbon::parse($request->input('monday_from'));
        $oWorkingTime->monday_to = Carbon::parse($request->input('monday_to'));
        $oWorkingTime->monday_dayoff = (boolean)$request->input('monday_dayoff');

        $oWorkingTime->tuesday_from = Carbon::parse($request->input('tuesday_from'));
        $oWorkingTime->tuesday_to = Carbon::parse($request->input('tuesday_to'));
        $oWorkingTime->tuesday_dayoff = (boolean)$request->input('tuesday_dayoff');

        $oWorkingTime->wednesday_from = Carbon::parse($request->input('wednesday_from'));
        $oWorkingTime->wednesday_to = Carbon::parse($request->input('wednesday_to'));
        $oWorkingTime->wednesday_dayoff = (boolean)$request->input('wednesday_dayoff');

        $oWorkingTime->thursday_from = Carbon::parse($request->input('thursday_from'));
        $oWorkingTime->thursday_to = Carbon::parse($request->input('thursday_to'));
        $oWorkingTime->thursday_dayoff = (boolean)$request->input('thursday_dayoff');

        $oWorkingTime->friday_from = Carbon::parse($request->input('friday_from'));
        $oWorkingTime->friday_to = Carbon::parse($request->input('friday_to'));
        $oWorkingTime->friday_dayoff = (boolean)$request->input('friday_dayoff');

        $oWorkingTime->saturday_from = Carbon::parse($request->input('saturday_from'));
        $oWorkingTime->saturday_to = Carbon::parse($request->input('saturday_to'));
        $oWorkingTime->saturday_dayoff = (boolean)$request->input('saturday_dayoff');

        $oWorkingTime->sunday_from = Carbon::parse($request->input('sunday_from'));
        $oWorkingTime->sunday_to = Carbon::parse($request->input('sunday_to'));
        $oWorkingTime->sunday_dayoff = (boolean)$request->input('sunday_dayoff');

        $oWorkingTime->save();

        \Session::flash('flash_message', 'Office Location saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/locations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oOfficeLocation = OfficeLocation::where('id',$id)->first();
        if(!$oOfficeLocation){
            \Session::flash('flash_message', 'Office Location is not valid or has been removed.');
            \Session::flash('flash_type', 'alert-error');
            return \Redirect::to('admin/locations');
        }

        $oOfficeLocation->delete();
        \Session::flash('flash_message', 'Office Location has been removed.');
        \Session::flash('flash_type', 'alert-success');
        return \Redirect::to('admin/locations');
    }

    public function locationCustomTime(Request $request){
        $this->_checkAjaxRequest();

        $oOfficeLocation = OfficeLocation::where('id',$request->input('location'))->first();
        if(!$oOfficeLocation){
            return $this->_failedJsonResponse([['Office Location is not valid or has been removed.']]);
        }

        if((int)$request->input('custom_time')>0){
            $oCustomTime = $oOfficeLocation->customWorkingTimes()
                            ->where('office_location_custom_working_times.id', $request->input('custom_time'))
                            ->first();
            if(!$oCustomTime){
                $oCustomTime = new OfficeLocationCustomWorkingTime;
                $oCustomTime->location_id = $oOfficeLocation->id;
            }
        }else{
            $oCustomTime = new OfficeLocationCustomWorkingTime;
            $oCustomTime->location_id = $oOfficeLocation->id;
        }

        $oCustomTime->is_dayoff = (bool)$request->input('is_dayoff');
        $oCustomTime->work_date = Carbon::parse($request->input('work_date'));
        $oCustomTime->start_time = Carbon::parse($request->input('start_time'));
        $oCustomTime->end_time = Carbon::parse($request->input('end_time'));
        $oCustomTime->save();
        $data['time'] = $oCustomTime;
        return $this->_successJsonResponse(['message'=>'Office Location Custom Time information saved.', 'data' => $data]);
    }

    public function removeLocationCustomTime(Request $request){
        $this->_checkAjaxRequest();

        $oOfficeLocation = OfficeLocation::where('id',$request->input('location'))->first();
        if(!$oOfficeLocation){
            return $this->_failedJsonResponse([['Office Location is not valid or has been removed.']]);
        }

        $oCustomTime = $oOfficeLocation->customWorkingTimes()
            ->where('office_location_custom_working_times.id', $request->input('ctime_id'))
            ->first();

        if(!$oCustomTime){
            return $this->_failedJsonResponse([['Office Location Custom Time is not valid or has been removed.']]);
        }

        $oCustomTime->delete();

        return $this->_successJsonResponse(['message'=>'Office Location Custom Time information removed.']);
    }

    public function loadLocationCustomTime(Request $request){
        $this->_checkAjaxRequest();

        $oOfficeLocation = OfficeLocation::where('id',$request->input('location'))->first();
        if(!$oOfficeLocation){
            return $this->_failedJsonResponse([['Office Location is not valid or has been removed.']]);
        }

        $oCustomTime = $oOfficeLocation->customWorkingTimes()
            ->where('office_location_custom_working_times.id', $request->input('ctime_id'))
            ->first();

        if(!$oCustomTime){
            return $this->_failedJsonResponse([['Office Location Custom Time is not valid or has been removed.']]);
        }
        $data['time'] = $oCustomTime;
        return $this->_successJsonResponse(['message'=>'Office Location Custom Time information removed.', 'data' =>$data]);
    }
}
