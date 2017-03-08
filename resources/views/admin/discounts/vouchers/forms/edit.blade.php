<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
        <li><a href="#calendar" data-toggle="tab">Calendar</a></li>
    </ul>

    <div class="tab-content">
        <div id="details" class="tab-pane active">
            <div class="form-group">
                <label for="voucher_code" class="col-sm-2 control-label">Voucher Code</label>
                <div class="col-sm-10">
                    {!! Form::text('voucher_code', null, ['class' => 'form-control', 'id' => 'voucher_code', 'placeholder' => 'Voucher Code']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="amount" class="col-sm-2 control-label">Discount</label>
                <div class="col-sm-10">
                    {!! Form::number('amount', null, ['class' => 'form-control', 'id' => 'amount', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}&nbsp;
                    {!! Form::select('amount_type', config('settings.discount_type'),null ,array('class'=>'form-control','id'=>'amount_type', 'style' => 'width:180px; display:inline')) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="products" class="col-sm-2 control-label">Products</label>
                <div class="col-sm-10">
                    <select name="products[]" id="products" multiple="multiple" class="form-control select2" >
                        @foreach($oCarTypes as $oCarType)
                            <optgroup class="select2-result-selectable" label="{{ $oCarType->name }}">
                                @foreach($oCarType->cars as $oCar)
                                    <option {{ (in_array($oCar->id, $oDiscount->cars->pluck('id')->toArray()))?'selected':''  }} value="{{ $oCar->id }}">{{ $oCar->make }} - {{ $oCar->model }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-success save-voucher">Submit</button>
                </div>
            </div>
        </div>

        <div id="calendar" class="tab-pane">
            <div class="form-group">
                <label for="date_from" class="col-sm-2 control-label">From</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        {!! Form::text('date_from', $oDiscount->recurring->repititions()->orderBy('start_repeat', 'ASC')->first()->start_repeat, ['class' => 'form-control', 'id' => 'date_from', 'placeholder' => 'Date From']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="date_to" class="col-sm-2 control-label">To</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        {!! Form::text('date_to', $oDiscount->recurring->repititions()->orderBy('start_repeat', 'ASC')->first()->end_repeat, ['class' => 'form-control', 'id' => 'date_to', 'placeholder' => 'Date To']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="frequency" class="col-sm-2 control-label">Recurrence</label>
                <div class="col-sm-10">
                    {!! Form::select('frequency', config('settings.recurrence_types'),$oDiscount->recurring->frequency,array('class'=>'form-control', 'id'=>'frequency')) !!}
                </div>
            </div>

            <div class="form-group">
                <table class="table recur-table">
                    <tbody>
                    <tr class="hidden" id="daily_recur">
                        <td>
                            <div class="form-group"><label class="col-sm-2 control-label">Repeating Every</label>
                                <div class="col-sm-4"><select style="display: inline;width: 30%;" class="form-control"
                                                              name="daily_recurrence"
                                                              id="daily_recurrence">
                                        @for($i=1;$i<=14;$i++)
                                            <option {{ ($oDiscount->recurring->frequency=='daily' && $oDiscount->recurring->interval==$i)?'selected':''  }} value="{{ $i }}">{{$i}}</option>
                                        @endfor
                                    </select>&nbsp;&nbsp;Days</div>

                            </div>
                        </td>
                    </tr>
                    <tr class="hidden" id="weekly_recur">
                        <td>
                            <div class="form-group"><label class="col-sm-2 control-label">Repeating Every</label>
                                <div class="col-sm-4"><select style="display: inline;width: 30%;" class="form-control"
                                                              name="weekly_recurrence"
                                                              id="weekly_recurrence">
                                        @for($i=1;$i<=4;$i++)
                                            <option {{ ($oDiscount->recurring->frequency=='weekly' && $oDiscount->recurring->interval==$i)?'selected':''  }} value="{{ $i }}">{{$i}}</option>
                                        @endfor
                                    </select>&nbsp;&nbsp;Week</div>

                            </div>
                        </td>
                    </tr>
                    <tr class="hidden" id="monthly_recur">
                        <td>
                            <div class="form-group"><label class="col-sm-2 control-label">Repeating Every</label>
                                <div class="col-sm-4"><select style="display: inline;width: 30%;" class="form-control"
                                                              name="monthly_recurrence"
                                                              id="monthly_recurrence">
                                        @for($i=1;$i<=12;$i++)
                                            <option {{ ($oDiscount->recurring->frequency=='monthly' && $oDiscount->recurring->interval==$i)?'selected':''  }} value="{{ $i }}">{{$i}}</option>
                                        @endfor
                                    </select>&nbsp;&nbsp;Month</div>

                            </div>
                        </td>
                    </tr>
                    <tr class="hidden" id="end_recur">
                        <td>
                            <div class="form-group"><label class="col-sm-2 control-label">Recurrence Counter</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        {!! Form::text('recurrence_end', $oDiscount->recurring->until_date, ['class' => 'form-control', 'id' => 'recurrence_end', 'placeholder' => 'Recurrence end']) !!}
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-success save-voucher">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>