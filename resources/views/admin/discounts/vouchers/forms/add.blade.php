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
                            <option value="{{ $oCar->id }}">{{ $oCar->make }} - {{ $oCar->model }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-success save-reservation">Submit</button>
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
                        {!! Form::text('date_from',null, ['class' => 'form-control', 'id' => 'date_from', 'placeholder' => 'Date From']) !!}
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
                        {!! Form::text('date_to', null, ['class' => 'form-control', 'id' => 'date_to', 'placeholder' => 'Date To']) !!}
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>