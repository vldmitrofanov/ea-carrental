<?php

namespace App\Http\Controllers\Admin\Discounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Types;
use App\DiscountFreebies;
use App\Http\Requests\DiscountFreebieRequest;
use App\DiscountFreebiesPeriod;

class FreebiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oDiscounts = DiscountFreebies::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.discounts.freebies.index', compact('oDiscounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oTypes = Types::get();
        return view('admin.discounts.freebies.add', compact('oTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DiscountVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountFreebieRequest $request)
    {
        $this->_checkAjaxRequest();

        $result = \DB::transaction(function () use ($request) {
            try{
                $oDiscount = new DiscountFreebies;
                $oDiscount->name = $request->input('name');
                $oDiscount->booking_duration = $request->input('booking_duration');
                $oDiscount->booking_duration_type = $request->input('booking_duration_type');
                $oDiscount->description = $request->input('description');
//                $oDiscount->start_date = Carbon::parse($request->input('start_date'));
//                $oDiscount->end_date = Carbon::parse($request->input('end_date'));

                if($oDiscount->save()){
                    if(is_array($request->input('models'))) {
                        $oDiscount->carModels()->sync($request->input('models'));
                    }else{
                        $oDiscount->carModels()->sync([]);
                    }

                    if(is_array($request->input('start_date'))) {
                        foreach ($request->input('start_date') as $key=>$val){
                            $oPeriod = new DiscountFreebiesPeriod;
                            $oPeriod->discount_freebies_id = $oDiscount->id;
                            $oPeriod->start_date = Carbon::parse($val);
                            $oPeriod->end_date = Carbon::parse($request->input('end_date')[$key]);
                            $oPeriod->save();
                        }
                    }

                    return $this->_successJsonResponse(['message'=>'Freebie Discount information saved.']);
                }else{
                    return $this->_failedJsonResponse([['Failed to save Freebie Discount Information.']]);
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
        $oDiscount = DiscountFreebies::where('id', $id)->firstOrFail();
        $oTypes = Types::get();
        return view('admin.discounts.freebies.edit', compact('oTypes', 'oDiscount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountFreebieRequest $request)
    {
        $this->_checkAjaxRequest();

        $oDiscount = DiscountFreebies::where('id', $request->input('voucher'))->first();
        if(!$oDiscount){
            return $this->_failedJsonResponse([['<strong>Freebie Discount</strong> is not valid or has been removed.']]);
        }

        $result = \DB::transaction(function () use ($request, $oDiscount) {
            try{
                $oDiscount->name = $request->input('name');
                $oDiscount->booking_duration = $request->input('booking_duration');
                $oDiscount->booking_duration_type = $request->input('booking_duration_type');
                $oDiscount->description = $request->input('description');
                $oDiscount->save();

                if(is_array($request->input('models'))) {
                    $oDiscount->carModels()->sync($request->input('models'));
                }else{
                    $oDiscount->carModels()->sync([]);
                }

                $oDiscount->periods()->delete();

                if(is_array($request->input('start_date'))) {
                    foreach ($request->input('start_date') as $key=>$val){
                        $oPeriod = new DiscountFreebiesPeriod;
                        $oPeriod->discount_freebies_id = $oDiscount->id;
                        $oPeriod->start_date = Carbon::parse($val);
                        $oPeriod->end_date = Carbon::parse($request->input('end_date')[$key]);
                        $oPeriod->save();
                    }
                }

                return $this->_successJsonResponse(['message'=>'Freebie Discount information saved.']);

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
        //
    }
}
