<div class="box-body">
    <div class="form-group">
        {!! Form::label('type_id', 'Type') !!}
        <select name="type_id" id="type_id" class="form-control">
            <option value="">Select Type</option>
            @foreach($oTypes as $oType)
                <option {{ ($oRentalCar && $oRentalCar->type_id==$oType->id)?'selected':''  }} value="{{ $oType->id }}" data-size="{{ ($oType->vehicleSize)?$oType->vehicleSize->description:'-'  }}" data-doors="{{ ($oType->vehicleDoors)?$oType->vehicleDoors->description:'-'  }}" data-transmission="{{ ($oType->vehicleTransmissionAndDrive)?$oType->vehicleTransmissionAndDrive->description:'-'  }}" data-fuel="{{ ($oType->vehicleFuelAndAC)?$oType->vehicleFuelAndAC->description:'-'  }}">{{ ($oType->vehicleSize)?$oType->vehicleSize->code_letter:'-'  }}{{ ($oType->vehicleDoors)?$oType->vehicleDoors->code_letter:'-'  }}{{ ($oType->vehicleTransmissionAndDrive)?$oType->vehicleTransmissionAndDrive->code_letter:'-'  }}{{ ($oType->vehicleFuelAndAC)?$oType->vehicleFuelAndAC->code_letter:'-'  }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        {!! Form::label('model_id', 'Make & Model') !!}
        <select name="model_id" id="model_id" class="form-control">
            <option value="">Select Make & Model</option>
        </select>
    </div>

    <div class="form-group">
        {!! Form::label('registration_number', 'Registration number') !!}
        {!! Form::text('registration_number', null, ['class' => 'form-control', 'id' => 'registration_number', 'placeholder' => 'Registration number']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('url_token', 'URL Token') !!}
        {!! Form::text('url_token', null, ['class' => 'form-control', 'id' => 'url_token', 'placeholder' => 'Car URL Token']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('current_mileage', 'Current Mileage (@/km)') !!}
        {!! Form::text('current_mileage', null, ['class' => 'form-control', 'id' => 'current_mileage', 'placeholder' => 'Current Mileage']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('location_id', 'Default Location') !!}
        <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="When the system assigns a vehicle to a reservation it does not matter what is the location of the vehicle. But you can set default vehicle location to make car inventory management easier.">
        {!! Form::select('location_id', array(''=>'Please Select')+$oOfficeLocations,null,array('class'=>'form-control','id'=>'location_id')) !!}
    </div>

    <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <input name="thumb_image" type="file">
    </div>

    @if($oRentalCar && Storage::disk('s3')->has($oRentalCar->thumb_image))
        <div class="form-group">
            <label for="exampleInputFile" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <img width="150" src="{{Storage::disk('s3')->url($oRentalCar->thumb_image)}}">
            </div>
        </div>
    @endif

</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! $submit_button !!}</button>
</div>
{!! Form::close() !!}