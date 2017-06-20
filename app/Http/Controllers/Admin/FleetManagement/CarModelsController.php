<?php

namespace App\Http\Controllers\Admin\FleetManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\CarModel;
use App\Types;
use App\CarExtra;
use App\Http\Requests\CarModelsRequest;
use App\CarModelPrice;
use Storage;

class CarModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oCarModels = CarModel::paginate(15);
        return view('admin.fleet_management.models.index', compact('oCarModels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oTypes = Types::get();
        $oExtras = CarExtra::orderBy('name')->pluck('name','id')->toArray();
        return view('admin.fleet_management.models.add', compact('oExtras', 'oTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarModelsRequest $request)
    {

        $oCarModel = new CarModel;
        $oCarModel->type_id = $request->input('type_id');
        $oCarModel->make = $request->input('make');
        $oCarModel->model = $request->input('model');
        $oCarModel->price_per_day = $request->input('price_per_day');
        $oCarModel->price_per_hour = $request->input('price_per_hour');
        $oCarModel->limit_mileage = $request->input('limit_mileage');
        $oCarModel->extra_mileage = $request->input('extra_mileage');
        $oCarModel->total_passengers = $request->input('total_passengers');
        $oCarModel->total_bags = $request->input('total_bags');
        $oCarModel->total_bags = $request->input('total_bags');
        $oCarModel->description = ($request->input('description'))?:'';
        $oCarModel->save();
        if($request->file('type_image')){
            $imageName = time().'.'.$request->file('type_image')->getClientOriginalExtension();

            $t = Storage::disk('s3')->put($imageName, file_get_contents($request->file('type_image')));
//            $imageName = Storage::disk('s3')->url($imageName);
            $oCarModel->thumb_path = $imageName;
            $oCarModel->save();

//            $oCarModel->thumb_path = $request->file('type_image')->store('/public/uploads/car_models');
//            $oCarModel->save();
        }

        $available_extras = $request->input('available_extras');
        foreach ($available_extras as $key => $value) {
            if (empty($value)) {
                unset($available_extras[$key]);
            }
        }

        if(is_array($available_extras)) {
            $oCarModel->extras()->sync($available_extras);
        }else{
            $oCarModel->extras()->sync([]);
        }


        \Session::flash('flash_message', 'Car Type saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/fleet/models/'. $oCarModel->id.'/edit');
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
        $oCarModel = CarModel::where('id', $id)->firstOrFail();
        $oTypes = Types::get();
        $oExtras = CarExtra::orderBy('name')->pluck('name','id')->toArray();
        return view('admin.fleet_management.models.edit', compact('oCarModel', 'oExtras', 'oTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarModelsRequest $request, $id)
    {
        $oCarModel = CarModel::findOrFail($id);
        $oCarModel->type_id = $request->input('type_id');
        $oCarModel->make = $request->input('make');
        $oCarModel->model = $request->input('model');
        $oCarModel->price_per_day = $request->input('price_per_day');
        $oCarModel->price_per_hour = $request->input('price_per_hour');
        $oCarModel->limit_mileage = $request->input('limit_mileage');
        $oCarModel->extra_mileage = $request->input('extra_mileage');
        $oCarModel->total_passengers = $request->input('total_passengers');
        $oCarModel->total_bags = $request->input('total_bags');
        $oCarModel->total_bags = $request->input('total_bags');
        $oCarModel->description = ($request->input('description'))?:'';
        $oCarModel->save();

        if($request->file('type_image')){
            if($oCarModel->thumb_path) {
                Storage::disk('s3')->delete($oCarModel->thumb_path);
            }
            $imageName = time().'.'.$request->file('type_image')->getClientOriginalExtension();

            $t = Storage::disk('s3')->put($imageName, file_get_contents($request->file('type_image')));
//            $imageName = Storage::disk('s3')->url($imageName);
//            $oOfficeLocation->thumb_path = $request->file('thumb_image')->store('/public/uploads/office_locations');
            $oCarModel->thumb_path = $imageName;
            $oCarModel->save();

//            $oCarModel->thumb_path = $request->file('type_image')->store('/public/uploads/car_models');
//            $oCarModel->save();
        }

        $available_extras = $request->input('available_extras');
        if(is_array($available_extras)) {
        foreach ($available_extras as $key => $value) {
            if (empty($value)) {
                unset($available_extras[$key]);
            }
        }
        }
        if(is_array($available_extras)) {
            $oCarModel->extras()->sync($available_extras);
        }else{
            $oCarModel->extras()->sync([]);
        }

        \Session::flash('flash_message', 'Car Type saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/fleet/models/');
    }

    public function addCarTypeCustomRate(Request $request){
        $this->_checkAjaxRequest();

        $oCarModel = CarModel::where('id',$request->input('id'))->first();
        if(!$oCarModel){
            return $this->_failedJsonResponse([['Car Make and Model is not valid or has been removed.']]);
        }

        $oCarModelPrice = new CarModelPrice;
        $oCarModelPrice->model_id = $oCarModel->id;
        $oCarModelPrice->save();
        $data['price'] = $oCarModelPrice;
        return $this->_successJsonResponse(['message'=>'Car Make and Model Custom Rate information saved.', 'data' => $data]);
    }

    public function removeCarTypeCustomRate(Request $request){
        $this->_checkAjaxRequest();

        $oCarModel = CarModel::where('id',$request->input('id'))->first();
        if(!$oCarModel){
            return $this->_failedJsonResponse([['Car Make and Model is not valid or has been removed.']]);
        }

        $oPrice  = $oCarModel->prices()->where('id', $request->input('extra_id'))->first();
        if(!$oPrice){
            return $this->_failedJsonResponse([['Custom Rate ifnormation is not valid or has been removed.']]);
        }
        $oPrice->delete();
        return $this->_successJsonResponse(['message'=>'Car Make and Model Custom Rate information removed.']);
    }
}
