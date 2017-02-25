<?php

namespace App\Http\Controllers\Admin\CarTypes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CarType;
use App\CarExtra;
use App\CarTypePrice;
use App\Http\Requests\CarTypeAddRequest;
use Carbon\Carbon;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oCarTypes = CarType::paginate(15);
        return view('admin.car_types.types.index', compact('oCarTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oExtras = CarExtra::orderBy('name')->pluck('name','id')->toArray();
        return view('admin.car_types.types.add', compact('oExtras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarTypeAddRequest $request)
    {
        $oCarType = new CarType;
        $oCarType->name = $request->input('name');
        $oCarType->description = $request->input('description');
        $oCarType->price_per_day = $request->input('price_per_day');
        $oCarType->price_per_hour = $request->input('price_per_hour');
        $oCarType->limit_mileage = $request->input('limit_mileage');
        $oCarType->extra_mileage = $request->input('extra_mileage');
        $oCarType->total_passengers = $request->input('total_passengers');
        $oCarType->total_bags = $request->input('total_bags');
        $oCarType->total_doors = $request->input('total_doors');
        $oCarType->transmission = $request->input('transmission');
        $oCarType->save();
        if($request->file('type_image')){
//            $imageName = time(). $request->file('type_image')->getClientOriginalName();
//            $request->file('type_image')->move(
//                base_path() . '/public/uploads/car_types/', $imageName
//            );
//            $oCarType->thumb_path = '/uploads/car_types/'. $imageName;
            $oCarType->thumb_path = $request->file('type_image')->store('/public/uploads/car_types');
            $oCarType->save();
        }



        \Session::flash('flash_message', 'Car Type saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/types/'. $oCarType->id.'/edit');
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
        $oCarType = CarType::where('id', $id)->firstOrFail();
        $oExtras = CarExtra::orderBy('name')->pluck('name','id')->toArray();
        return view('admin.car_types.types.edit', compact('oCarType', 'oExtras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarTypeAddRequest $request, $id)
    {
        $oCarType = CarType::findOrFail($id);
        $oCarType->name = $request->input('name');
        $oCarType->description = $request->input('description');
        $oCarType->price_per_day = $request->input('price_per_day');
        $oCarType->price_per_hour = $request->input('price_per_hour');
        $oCarType->limit_mileage = $request->input('limit_mileage');
        $oCarType->extra_mileage = $request->input('extra_mileage');
        $oCarType->total_passengers = $request->input('total_passengers');
        $oCarType->total_bags = $request->input('total_bags');
        $oCarType->total_doors = $request->input('total_doors');
        $oCarType->transmission = $request->input('transmission');
        $oCarType->save();

        if($request->file('type_image')){
//            $imageName = time(). $request->file('type_image')->getClientOriginalName();
//            $request->file('type_image')->move(
//                base_path() . '/public/uploads/car_types/', $imageName
//            );
            $oCarType->thumb_path = $request->file('type_image')->store('/public/uploads/car_types');
//            $oCarType->thumb_path = '/uploads/car_types/'. $imageName;
            $oCarType->save();
        }

        if(is_array($request->input('date_from'))){
            foreach($request->input('date_from') as $key=>$val){
                $oPrice  = $oCarType->prices()->where('id', $key)->first();
                if(!$oPrice){
                    $oPrice = new CarTypePrice;
                    $oPrice->type_id = $oCarType->id;
                }
                $oPrice->date_from = Carbon::parse($val);
                $oPrice->date_to = Carbon::parse($request->input('date_from')[$key]);
                $oPrice->from = (int)$request->input('from')[$key];
                $oPrice->to = (int)$request->input('to')[$key];
                $oPrice->price = (float)$request->input('price')[$key];
                $oPrice->price_per = $request->input('price_per')[$key];
                $oPrice->save();
            }
        }
        if(is_array($request->input('available_extras'))) {
            $oCarType->extras()->sync($request->input('available_extras'));
        }else{
            $oCarType->extras()->sync([]);
        }

        \Session::flash('flash_message', 'Car Type saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/types/');
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

    public function addCarTypeCustomRate(Request $request){
        $this->_checkAjaxRequest();

        $oCarType = CarType::where('id',$request->input('type'))->first();
        if(!$oCarType){
            return $this->_failedJsonResponse([['Car Type is not valid or has been removed.']]);
        }

        $oCarTypePrice = new CarTypePrice;
        $oCarTypePrice->type_id = $oCarType->id;
        $oCarTypePrice->save();
        $data['price'] = $oCarTypePrice;
        return $this->_successJsonResponse(['message'=>'Car Type Custom Rate information saved.', 'data' => $data]);
    }

    public function removeCarTypeCustomRate(Request $request){
        $this->_checkAjaxRequest();

        $oCarType = CarType::where('id',$request->input('type'))->first();
        if(!$oCarType){
            return $this->_failedJsonResponse([['Car Type is not valid or has been removed.']]);
        }

        $oPrice  = $oCarType->prices()->where('id', $request->input('extra_id'))->first();
        if(!$oPrice){
            return $this->_failedJsonResponse([['Custom Rate ifnormation is not valid or has been removed.']]);
        }
        $oPrice->delete();
        return $this->_successJsonResponse(['message'=>'Car Type Custom Rate information removed.']);
    }
}
