<?php

namespace App\Http\Controllers\Admin\Discounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Discount;
use App\DiscountRecurringRule;
use App\DiscountRecurringRuleRepitition;
use App\Types;
use App\Http\Requests\DiscountVoucherRequest;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oDiscounts = Discount::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.discounts.vouchers.index', compact('oDiscounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oTypes = Types::get();
        return view('admin.discounts.vouchers.add', compact('oTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DiscountVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountVoucherRequest $request)
    {
        $this->_checkAjaxRequest();

        if($request->input('frequency')!='none' && $request->input('recurrence_end')=='' ) {
            return $this->_failedJsonResponse([['<strong>Recurrence Counter</strong> can\'t be empty.']]);
        }

        $result = \DB::transaction(function () use ($request) {
            try{
                $oDiscount = new Discount;
                $oDiscount->voucher_code = $request->input('voucher_code');
                $oDiscount->amount = $request->input('amount');
                $oDiscount->amount_type = $request->input('amount_type');
                if($request->input('models')){
                    $oDiscount->discount_type = 'selected';
                }
                if($oDiscount->save()){
                    if(is_array($request->input('models'))) {
                        $oDiscount->carModels()->sync($request->input('models'));
                    }else{
                        $oDiscount->carModels()->sync([]);
                    }

                    $oRecurringRule = new DiscountRecurringRule;
                    $oRecurringRule->voucher_id = $oDiscount->id;
                    $oRecurringRule->frequency = $request->input('frequency');
                    switch ($request->input('frequency')){
                        case"daily":
                            $oRecurringRule->interval = $request->input('daily_recurrence');
                            $oRecurringRule->until_date = Carbon::parse($request->input('recurrence_end'));
                            break;
                        case"weekly":
                            $oRecurringRule->interval = $request->input('weekly_recurrence');
                            $oRecurringRule->until_date = Carbon::parse($request->input('recurrence_end'));
                            break;
                        case"monthly":
                            $oRecurringRule->interval = $request->input('monthly_recurrence');
                            $oRecurringRule->until_date = Carbon::parse($request->input('recurrence_end'));
                            break;
                        default:
                                $oRecurringRule->until_date = Carbon::parse($request->input('date_to'));
                            break;
                    }
                    $oRecurringRule->save();


                    $oRepitition = new DiscountRecurringRuleRepitition;
                    $oRepitition->voucher_id = $oDiscount->id;
                    $oRepitition->rule_id = $oRecurringRule->id;
                    $oRepitition->start_repeat = Carbon::parse($request->input('date_from'));
                    $oRepitition->end_repeat = Carbon::parse($request->input('date_to'));
                    $oRepitition->save();

                    if($request->input('frequency')=='daily') {
                        $diffInHours = Carbon::parse($request->input('date_to'))->diffInHours(Carbon::parse($request->input('date_from')));
                        $dates = $this->dateRange(Carbon::parse($request->input('date_to'))->addDays($request->input('daily_recurrence')), Carbon::parse($request->input('recurrence_end')), $request->input('daily_recurrence').' day');
                        foreach($dates as $date){
                            $oRepitition = new DiscountRecurringRuleRepitition;
                            $oRepitition->voucher_id = $oDiscount->id;
                            $oRepitition->rule_id = $oRecurringRule->id;
                            $oRepitition->start_repeat = Carbon::parse($date)->addHours('-'.$diffInHours);
                            $oRepitition->end_repeat = Carbon::parse($date);
                            $oRepitition->save();
                        }
                    }else if($request->input('frequency')=='weekly') {
                        $diffInHours = Carbon::parse($request->input('date_to'))->diffInHours(Carbon::parse($request->input('date_from')));
                        $dates = $this->dateRange(Carbon::parse($request->input('date_to'))->addWeeks($request->input('weekly_recurrence')), Carbon::parse($request->input('recurrence_end')), $request->input('daily_recurrence').' week');
                        foreach($dates as $date){
                            $oRepitition = new DiscountRecurringRuleRepitition;
                            $oRepitition->voucher_id = $oDiscount->id;
                            $oRepitition->rule_id = $oRecurringRule->id;
                            $oRepitition->start_repeat = Carbon::parse($date)->addHours('-'.$diffInHours);
                            $oRepitition->end_repeat = Carbon::parse($date);
                            $oRepitition->save();
                        }
                    }else if($request->input('frequency')=='monthly') {
                        $diffInHours = Carbon::parse($request->input('date_to'))->diffInHours(Carbon::parse($request->input('date_from')));
                        $dates = $this->dateRange(Carbon::parse($request->input('date_to'))->addMonth($request->input('monthly_recurrence')), Carbon::parse($request->input('recurrence_end')), $request->input('monthly_recurrence').' month');
                        foreach($dates as $date){
                            $oRepitition = new DiscountRecurringRuleRepitition;
                            $oRepitition->voucher_id = $oDiscount->id;
                            $oRepitition->rule_id = $oRecurringRule->id;
                            $oRepitition->start_repeat = Carbon::parse($date)->addHours('-'.$diffInHours);
                            $oRepitition->end_repeat = Carbon::parse($date);
                            $oRepitition->save();
                        }
                    }
                    return $this->_successJsonResponse(['message'=>'Discount Voucher information saved.']);
                }else{
                    return $this->_failedJsonResponse([['Failed to save Discount Voucher Information.']]);
                }
            }catch (\Exception $e) {
                return $this->_failedJsonResponse([[$e->getMessage()]]);
            }
        });

        return $result;
    }

    public function dateRange($first, $last, $step = '+1 day', $format = 'Y-m-d H:i' ) {
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while( $current <= $last ) {
            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }
        return $dates;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $oDiscount = Discount::where('id', $id)->firstOrFail();
        return view('admin.discounts.vouchers.show', compact('oDiscount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oDiscount = Discount::where('id', $id)->firstOrFail();
        $oTypes = Types::get();
        return view('admin.discounts.vouchers.edit', compact('oTypes', 'oDiscount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountVoucherRequest $request)
    {
        $this->_checkAjaxRequest();

        if($request->input('frequency')!='none' && $request->input('recurrence_end')=='' ) {
            return $this->_failedJsonResponse([['<strong>Recurrence Counter</strong> can\'t be empty.']]);
        }

        $oDiscount = Discount::where('id', $request->input('voucher'))->first();
        if(!$oDiscount){
            return $this->_failedJsonResponse([['<strong>Discount Voucher</strong> is not valid or has been removed.']]);
        }

        $result = \DB::transaction(function () use ($request, $oDiscount) {
            try{
                $oDiscount->voucher_code = $request->input('voucher_code');
                $oDiscount->amount = $request->input('amount');
                $oDiscount->amount_type = $request->input('amount_type');
                if($request->input('models')){
                    $oDiscount->discount_type = 'selected';
                }else{
                    $oDiscount->discount_type = 'all';
                }
                $oDiscount->save();

                if(is_array($request->input('models'))) {
                    $oDiscount->carModels()->sync($request->input('models'));
                }else{
                    $oDiscount->carModels()->sync([]);
                }

                $oRecurringRule = $oDiscount->recurring;
                $oRecurringRule->voucher_id = $oDiscount->id;
                $oRecurringRule->frequency = $request->input('frequency');
                switch ($request->input('frequency')){
                    case"daily":
                        $oRecurringRule->interval = $request->input('daily_recurrence');
                        $oRecurringRule->until_date = Carbon::parse($request->input('recurrence_end'));
                        break;
                    case"weekly":
                        $oRecurringRule->interval = $request->input('weekly_recurrence');
                        $oRecurringRule->until_date = Carbon::parse($request->input('recurrence_end'));
                        break;
                    case"monthly":
                        $oRecurringRule->interval = $request->input('monthly_recurrence');
                        $oRecurringRule->until_date = Carbon::parse($request->input('recurrence_end'));
                        break;
                    default:
                        $oRecurringRule->until_date = Carbon::parse($request->input('date_to'));
                        break;
                }
                $oRecurringRule->save();

                $oRecurringRule->repititions()->delete();

                $oRepitition = new DiscountRecurringRuleRepitition;
                $oRepitition->voucher_id = $oDiscount->id;
                $oRepitition->rule_id = $oRecurringRule->id;
                $oRepitition->start_repeat = Carbon::parse($request->input('date_from'));
                $oRepitition->end_repeat = Carbon::parse($request->input('date_to'));
                $oRepitition->save();

                if($request->input('frequency')=='daily') {
                    $diffInHours = Carbon::parse($request->input('date_to'))->diffInHours(Carbon::parse($request->input('date_from')));
                    $dates = $this->dateRange(Carbon::parse($request->input('date_to'))->addDays($request->input('daily_recurrence')), Carbon::parse($request->input('recurrence_end')), $request->input('daily_recurrence').' day');
                    foreach($dates as $date){
                        $oRepitition = new DiscountRecurringRuleRepitition;
                        $oRepitition->voucher_id = $oDiscount->id;
                        $oRepitition->rule_id = $oRecurringRule->id;
                        $oRepitition->start_repeat = Carbon::parse($date)->addHours('-'.$diffInHours);
                        $oRepitition->end_repeat = Carbon::parse($date);
                        $oRepitition->save();
                    }
                }else if($request->input('frequency')=='weekly') {
                    $diffInHours = Carbon::parse($request->input('date_to'))->diffInHours(Carbon::parse($request->input('date_from')));
                    $dates = $this->dateRange(Carbon::parse($request->input('date_to'))->addWeeks($request->input('weekly_recurrence')), Carbon::parse($request->input('recurrence_end')), $request->input('daily_recurrence').' week');
                    foreach($dates as $date){
                        $oRepitition = new DiscountRecurringRuleRepitition;
                        $oRepitition->voucher_id = $oDiscount->id;
                        $oRepitition->rule_id = $oRecurringRule->id;
                        $oRepitition->start_repeat = Carbon::parse($date)->addHours('-'.$diffInHours);
                        $oRepitition->end_repeat = Carbon::parse($date);
                        $oRepitition->save();
                    }
                }else if($request->input('frequency')=='monthly') {
                    $diffInHours = Carbon::parse($request->input('date_to'))->diffInHours(Carbon::parse($request->input('date_from')));
                    $dates = $this->dateRange(Carbon::parse($request->input('date_to'))->addMonth($request->input('monthly_recurrence')), Carbon::parse($request->input('recurrence_end')), $request->input('monthly_recurrence').' month');
                    foreach($dates as $date){
                        $oRepitition = new DiscountRecurringRuleRepitition;
                        $oRepitition->voucher_id = $oDiscount->id;
                        $oRepitition->rule_id = $oRecurringRule->id;
                        $oRepitition->start_repeat = Carbon::parse($date)->addHours('-'.$diffInHours);
                        $oRepitition->end_repeat = Carbon::parse($date);
                        $oRepitition->save();
                    }
                }
                return $this->_successJsonResponse(['message'=>'Discount Voucher information saved.']);

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
        $oDiscount = Discount::where('id',$id)->first();
        if(!$oDiscount){
            \Session::flash('flash_message', 'Discount not valid or has been removed.');
            \Session::flash('flash_type', 'alert-error');
            return \Redirect::to('admin/discounts/vouchers');
        }

        $oDiscount->delete();
        \Session::flash('flash_message', 'Discount Information has been removed.');
        \Session::flash('flash_type', 'alert-success');
        return \Redirect::to('admin/discounts/vouchers');
    }
}
