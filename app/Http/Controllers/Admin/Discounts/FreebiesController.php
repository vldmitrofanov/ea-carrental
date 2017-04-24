<?php

namespace App\Http\Controllers\Admin\Discounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\CarType;
use App\DiscountFreebies;
use App\Http\Requests\DiscountFreebieRequest;

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
        $oCarTypes = CarType::orderBy('name', 'DESC')->get();
        return view('admin.discounts.freebies.add', compact('oCarTypes'));
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
                $oDiscount->start_date = Carbon::parse($request->input('start_date'));
                $oDiscount->end_date = Carbon::parse($request->input('end_date'));
                if($request->input('products')){
                    $oDiscount->discount_package_type = 'selected';
                }
                if($oDiscount->save()){
                    if(is_array($request->input('products'))) {
                        $oDiscount->cars()->sync($request->input('products'));
                    }else{
                        $oDiscount->cars()->sync([]);
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
        $oCarTypes = CarType::orderBy('name', 'DESC')->get();
        return view('admin.discounts.freebies.edit', compact('oCarTypes', 'oDiscount'));
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
                $oDiscount->start_date = Carbon::parse($request->input('start_date'));
                $oDiscount->end_date = Carbon::parse($request->input('end_date'));
                if($request->input('products')){
                    $oDiscount->discount_package_type = 'selected';
                }else{
                    $oDiscount->discount_package_type = 'all';
                }
                $oDiscount->save();

                if(is_array($request->input('products'))) {
                    $oDiscount->cars()->sync($request->input('products'));
                }else{
                    $oDiscount->cars()->sync([]);
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
