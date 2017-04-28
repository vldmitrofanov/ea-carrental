<?php

namespace App\Http\Controllers\Admin\FleetManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\SIPPCode;
use App\Types as FleetType;
use App\Http\Requests\TypesRequest;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oFleetTypes = FleetType::paginate(15);
        return view('admin.fleet_management.types.index', compact('oFleetTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oCodes = SIPPCode::orderBy('code_letter')->get();
        return view('admin.fleet_management.types.add', compact('oCodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypesRequest $request)
    {
        $oFleetType = new FleetType;
        $oFleetType->sipp_code_one = ($request->input('sipp_code_one'))?:0;
        $oFleetType->sipp_code_two = ($request->input('sipp_code_two'))?:0;
        $oFleetType->sipp_code_three = ($request->input('sipp_code_three'))?:0;
        $oFleetType->sipp_code_four = ($request->input('sipp_code_four'))?:0;
        $oFleetType->save();

        \Session::flash('flash_message', 'Type saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/fleet/types');
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
        $oFleetType = FleetType::where('id', $id)->firstOrFail();
        $oCodes = SIPPCode::orderBy('code_letter')->get();
        return view('admin.fleet_management.types.edit', compact('oFleetType', 'oCodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypesRequest $request, $id)
    {
        $oFleetType = FleetType::findOrFail($id);
        $oFleetType->sipp_code_one = ($request->input('sipp_code_one'))?:0;
        $oFleetType->sipp_code_two = ($request->input('sipp_code_two'))?:0;
        $oFleetType->sipp_code_three = ($request->input('sipp_code_three'))?:0;
        $oFleetType->sipp_code_four = ($request->input('sipp_code_four'))?:0;
        $oFleetType->save();

        \Session::flash('flash_message', 'Type saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/fleet/types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
