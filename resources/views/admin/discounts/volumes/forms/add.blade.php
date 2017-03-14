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
            <label for="date_from" class="col-sm-2 control-label">From</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    {!! Form::text('start_date',null, ['class' => 'form-control', 'id' => 'start_date', 'placeholder' => 'Date From']) !!}
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
                    {!! Form::text('end_date', null, ['class' => 'form-control', 'id' => 'end_date', 'placeholder' => 'Date To']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="products" class="col-sm-2 control-label">Valid for</label>
            <div class="col-sm-10">
                <select name="products[]" id="products" multiple="multiple" class="form-control select2">
                    @foreach($oCarTypes as $oCarType)
                        <optgroup class="select2-result-selectable" label="{{ $oCarType->name }}">
                            @foreach($oCarType->cars as $oCar)
                                <option value="{{ $oCar->id }}">{{ $oCar->make }} - {{ $oCar->model }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
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