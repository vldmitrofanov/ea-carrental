<?php

namespace App\Http\Controllers\Admin\Discounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\DiscountVolume;
use App\Types;
use App\Http\Requests\DiscountVolumeRequest;
use App\DiscountPackagePeriod;

class VolumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oDiscounts = DiscountVolume::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.discounts.volumes.index', compact('oDiscounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oTypes = Types::get();
        return view('admin.discounts.volumes.add', compact('oTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DiscountVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountVolumeRequest $request)
    {
        $this->_checkAjaxRequest();

        $result = \DB::transaction(function () use ($request) {
            try{
                $oDiscount = new DiscountVolume;
                $oDiscount->name = $request->input('name');
                $oDiscount->discount_amount = $request->input('discount_amount');
                $oDiscount->discount_type = $request->input('discount_type');
                $oDiscount->booking_duration = $request->input('booking_duration');
                $oDiscount->booking_duration_type = $request->input('booking_duration_type');
                $oDiscount->description = $request->input('description');

                if($request->input('models')){
                    $oDiscount->discount_package_type = 'selected';
                }
                if($oDiscount->save()){
                    if(is_array($request->input('models'))) {
                        $oDiscount->carModels()->sync($request->input('models'));
                    }else{
                        $oDiscount->carModels()->sync([]);
                    }

                    if(is_array($request->input('start_date'))) {
                        foreach ($request->input('start_date') as $key=>$val){
                            $oPeriod = new DiscountPackagePeriod;
                            $oPeriod->discount_package_id = $oDiscount->id;
                            $oPeriod->start_date = Carbon::parse($val);
                            $oPeriod->end_date = Carbon::parse($request->input('end_date')[$key]);
                            $oPeriod->save();
                        }
                    }

                    return $this->_successJsonResponse(['message'=>'Volume based Discount information saved.']);
                }else{
                    return $this->_failedJsonResponse([['Failed to save Volume based Discount Information.']]);
                }
            }catch (\Exception $e) {
                return $this->_failedJsonResponse([[$e->getMessage()]]);
            }
        });

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oDiscount = DiscountVolume::where('id', $id)->firstOrFail();
        $oTypes = Types::get();
        return view('admin.discounts.volumes.edit', compact('oTypes', 'oDiscount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountVolumeRequest $request)
    {
        $this->_checkAjaxRequest();

        $oDiscount = DiscountVolume::where('id', $request->input('voucher'))->first();
        if(!$oDiscount){
            return $this->_failedJsonResponse([['<strong>Volume Based Discount</strong> is not valid or has been removed.']]);
        }

        $result = \DB::transaction(function () use ($request, $oDiscount) {
            try{
                $oDiscount->name = $request->input('name');
                $oDiscount->discount_amount = $request->input('discount_amount');
                $oDiscount->discount_type = $request->input('discount_type');
                $oDiscount->booking_duration = $request->input('booking_duration');
                $oDiscount->booking_duration_type = $request->input('booking_duration_type');
                $oDiscount->description = $request->input('description');
                if($request->input('models')){
                    $oDiscount->discount_package_type = 'selected';
                }else{
                    $oDiscount->discount_package_type = 'all';
                }
                $oDiscount->save();

                if(is_array($request->input('models'))) {
                    $oDiscount->carModels()->sync($request->input('models'));
                }else{
                    $oDiscount->carModels()->sync([]);
                }

                $oDiscount->periods()->delete();

                if(is_array($request->input('start_date'))) {
                    foreach ($request->input('start_date') as $key=>$val){
                        $oPeriod = new DiscountPackagePeriod;
                        $oPeriod->discount_package_id = $oDiscount->id;
                        $oPeriod->start_date = Carbon::parse($val);
                        $oPeriod->end_date = Carbon::parse($request->input('end_date')[$key]);
                        $oPeriod->save();
                    }
                }

                return $this->_successJsonResponse(['message'=>'Volume based Discount information saved.']);

            }catch (\Exception $e) {
                return $this->_failedJsonResponse([[$e->getMessage()]]);
            }
        });

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oDiscountVolume = DiscountVolume::where('id',$id)->first();
        if(!$oDiscountVolume){
            \Session::flash('flash_message', 'Volume Discount not valid or has been removed.');
            \Session::flash('flash_type', 'alert-error');
            return \Redirect::to('admin/discounts/volume');
        }

        $oDiscountVolume->delete();
        \Session::flash('flash_message', 'Volume Discount Information has been removed.');
        \Session::flash('flash_type', 'alert-success');
        return \Redirect::to('admin/discounts/volume');
    }

    /**
     * Function to mark car as featured and vice versa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function featured($id){
        $this->_checkAjaxRequest();

        $oDiscountVolume = DiscountVolume::where('id', $id)->first();
        if(!$oDiscountVolume){
            return $this->_failedJsonResponse([['Discount is not valid or has been removed.']]);
        }

        $oDiscountVolume->featured = !$oDiscountVolume->featured;
        $oDiscountVolume->save();
        return $this->_successJsonResponse(['message'=>'Discount information is updated.', 'data' => $oDiscountVolume]);
    }
}
