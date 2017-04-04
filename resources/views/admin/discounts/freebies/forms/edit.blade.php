<div class="nav-tabs-custom">
    <div class="tab-content">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Freebie Name</label>
            <div class="col-sm-10">
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Discount Name']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="booking_duration" class="col-sm-2 control-label">Discount Condition</label>
            <div class="col-sm-10">
                {!! Form::number('booking_duration', null, ['class' => 'form-control', 'id' => 'booking_duration', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}
                &nbsp;
                {!! Form::select('booking_duration_type', config('settings.booking_duration_type'),null ,array('class'=>'form-control','id'=>'booking_duration_type', 'style' => 'width:180px; display:inline')) !!}
            </div>
        </div>

        <div class="form-group">
            <table class="table periods-table">
                <tbody>
                @if($oDiscount->periods->count()==0)
                    <tr class="">
                        <td>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        {!! Form::text('start_date[]',null, ['class' => 'form-control', 'id' => 'start_date_0', 'placeholder' => 'Date From']) !!}
                                    </div>&nbsp</div>

                                <div class="col-sm-4"><div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        {!! Form::text('end_date[]', null, ['class' => 'form-control', 'id' => 'end_date_0', 'placeholder' => 'Date To']) !!}
                                    </div>&nbsp</div>

                                <div class="col-sm-2"><button type="button" class="btn btn-info btn-addperiod"><i class="fa fa-plus"></i> Add Period</button></div>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach($oDiscount->periods as $index=>$oPeriod)
                        <tr id="{{$index}}">
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            {!! Form::text('start_date[]',$oPeriod->start_date, ['class' => 'form-control', 'id' => "start_date_$index", 'placeholder' => 'Date From']) !!}
                                        </div>&nbsp</div>

                                    <div class="col-sm-4"><div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            {!! Form::text('end_date[]', $oPeriod->end_date, ['class' => 'form-control', 'id' => "end_date_$index", 'placeholder' => 'Date To']) !!}
                                        </div>&nbsp</div>

                                    <div class="col-sm-2">
                                        @if($index==0)
                                            <button type="button" class="btn btn-info btn-addperiod"><i class="fa fa-plus"></i> Add Period</button>
                                        @else
                                            <a href="javascript:;" class="remove-period"  data-id="{{$index}}"><i class="fa fa-trash" style="padding-top: 8px;"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <table class="table products-table">
                <tbody>
                @if($oDiscount->carModels->count()==0)
                    <tr class="">
                        <td>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <select style="display: inline;" onchange="loadModels(this)" class="form-control" name="types[]" id="types_0" data-index="0">
                                        <option value="">Type</option>
                                        @foreach($oTypes as $oType)
                                            <option value="{{ $oType->id }}">{{ ($oType->vehicleSize)?$oType->vehicleSize->code_letter:'-'  }}{{ ($oType->vehicleDoors)?$oType->vehicleDoors->code_letter:'-'  }}{{ ($oType->vehicleTransmissionAndDrive)?$oType->vehicleTransmissionAndDrive->code_letter:'-'  }}{{ ($oType->vehicleFuelAndAC)?$oType->vehicleFuelAndAC->code_letter:'-'  }}</option>
                                        @endforeach
                                    </select>&nbsp</div>

                                <div class="col-sm-4"><select style="display: inline;" class="form-control" name="models[]" id="models_0" data-index="0">
                                        <option value="">Make & Model</option>
                                    </select>&nbsp</div>

                                <div class="col-sm-2"><button type="button" class="btn btn-info btn-addtype"><i class="fa fa-plus"></i> Add Type</button></div>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach($oDiscount->carModels as $index=>$oCarModel)
                        <tr id="{{$index}}">
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <select style="display: inline;" onchange="loadModels(this)" class="form-control" name="types[]" id="types_{{$index}}" data-index="{{$index}}">
                                            <option value="">Type</option>
                                            @foreach($oTypes as $oType)
                                                <option {{ ($oType->id==$oCarModel->type_id)?'selected':''  }} value="{{ $oType->id }}">{{ ($oType->vehicleSize)?$oType->vehicleSize->code_letter:'-'  }}{{ ($oType->vehicleDoors)?$oType->vehicleDoors->code_letter:'-'  }}{{ ($oType->vehicleTransmissionAndDrive)?$oType->vehicleTransmissionAndDrive->code_letter:'-'  }}{{ ($oType->vehicleFuelAndAC)?$oType->vehicleFuelAndAC->code_letter:'-'  }}</option>
                                            @endforeach
                                        </select>&nbsp</div>

                                    <div class="col-sm-4">
                                        <select style="display: inline;" data-m="{{$oCarModel->id}}" class="form-control" name="models[]" id="models_{{$index}}" data-index="{{$index}}">
                                            <option value="">Make & Model</option>
                                        </select>&nbsp</div>

                                    <div class="col-sm-2">
                                        @if($index==0)
                                            <button type="button" class="btn btn-info btn-addtype"><i class="fa fa-plus"></i> Add Type</button>
                                        @else
                                            <a href="javascript:;" class="remove-type"  data-id="{{$index}}"><i class="fa fa-trash" style="padding-top: 8px;"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                {!! Form::textarea ('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Offer Description']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-success save-voucher">Submit</button>
            </div>
        </div>

    </div>
</div>