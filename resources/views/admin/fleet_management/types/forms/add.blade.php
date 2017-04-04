<div class="box-body">
    <div class="form-group">
        {!! Form::label('sipp_code_one', 'Size of Vehicle') !!}
        <select name="sipp_code_one" id="sipp_code_one" class="form-control">
            <option value="">Select Vehicle Size</option>
            @foreach($oCodes->where('code_type','A') as $oCode)
                <option value="{{ $oCode->id }}">{{ $oCode->code_letter  }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        {!! Form::label('sipp_code_two', 'Number of doors') !!}
        <select name="sipp_code_two" id="sipp_code_two" class="form-control">
            <option value="">Select Number of doors</option>
            @foreach($oCodes->where('code_type','B') as $oCode)
                <option value="{{ $oCode->id }}">{{ $oCode->code_letter  }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        {!! Form::label('sipp_code_three', 'Transmission & drive') !!}
        <select name="sipp_code_three" id="sipp_code_three" class="form-control">
            <option value="">Select Transmission & drive</option>
            @foreach($oCodes->where('code_type','C') as $oCode)
                <option value="{{ $oCode->id }}">{{ $oCode->code_letter  }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        {!! Form::label('sipp_code_four', 'Fuel & A/C') !!}
        <select name="sipp_code_four" id="sipp_code_four" class="form-control">
            <option value="">Select Fuel & A/C</option>
            @foreach($oCodes->where('code_type','D') as $oCode)
                <option value="{{ $oCode->id }}">{{ $oCode->code_letter  }}</option>
            @endforeach
        </select>
    </div>

</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! $submit_button !!}</button>
</div>
{!! Form::close() !!}