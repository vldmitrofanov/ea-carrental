<div class="nav-tabs-custom">
    <div class="tab-content">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Discount Name</label>
            <div class="col-sm-10">
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Discount Name']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="discount_amount" class="col-sm-2 control-label">Discount Value</label>
            <div class="col-sm-10">
                {!! Form::number('discount_amount', null, ['class' => 'form-control', 'id' => 'discount_amount', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}
                &nbsp;
                {!! Form::select('discount_type', config('settings.discount_type'),null ,array('class'=>'form-control','id'=>'discount_type', 'style' => 'width:180px; display:inline')) !!}
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
                </tbody>
            </table>
        </div>


        <div class="form-group">
            <table class="table products-table">
                <tbody>
                <tr class="">
                    <td>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <select style="display: inline;" onchange="loadModels(this)" class="form-control" required name="types[]" id="types_0" data-index="0">
                                    <option value="">Type</option>
                                    @foreach($oTypes as $oType)
                                        <option value="{{ $oType->id }}">{{ ($oType->vehicleSize)?$oType->vehicleSize->code_letter:'-'  }}{{ ($oType->vehicleDoors)?$oType->vehicleDoors->code_letter:'-'  }}{{ ($oType->vehicleTransmissionAndDrive)?$oType->vehicleTransmissionAndDrive->code_letter:'-'  }}{{ ($oType->vehicleFuelAndAC)?$oType->vehicleFuelAndAC->code_letter:'-'  }}</option>
                                    @endforeach
                                </select>&nbsp</div>

                            <div class="col-sm-4"><select style="display: inline;" class="form-control models" name="models[]" required id="models_0" data-index="0">
                                    <option value="">Make & Model</option>
                                </select>&nbsp</div>

                            <div class="col-sm-2"><button type="button" class="btn btn-info btn-addtype"><i class="fa fa-plus"></i> Add Type</button></div>
                        </div>
                    </td>
                </tr>
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