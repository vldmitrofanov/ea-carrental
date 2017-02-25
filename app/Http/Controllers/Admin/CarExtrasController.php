<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CarExtra;
use App\Http\Requests\CarExtraRequest;

class CarExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oCarExtras = CarExtra::paginate(15);
        return view('admin.car_types.extras.index', compact('oCarExtras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car_types.extras.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarExtraRequest $request)
    {
        $oCarExtra = new CarExtra;
        $oCarExtra->name = $request->input('name');
        $oCarExtra->price = $request->input('price');
        $oCarExtra->per = $request->input('per');
        $oCarExtra->type = $request->input('type');
        $oCarExtra->save();

        \Session::flash('flash_message', 'Car Extra saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/extras');
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
        $oCarExtra = CarExtra::where('id', $id)->firstOrFail();
        return view('admin.car_types.extras.edit', compact('oCarExtra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarExtraRequest $request, $id)
    {
        $oCarExtra = CarExtra::findOrFail($id);
        $oCarExtra->name = $request->input('name');
        $oCarExtra->price = $request->input('price');
        $oCarExtra->per = $request->input('per');
        $oCarExtra->type = $request->input('type');
        $oCarExtra->save();

        \Session::flash('flash_message', 'Car Extra saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/extras');
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
