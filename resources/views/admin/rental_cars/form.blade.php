<div class="box-body">
    <div class="form-group">
        {!! Form::label('make', 'Make') !!}
        {!! Form::text('make', null, ['class' => 'form-control', 'id' => 'make', 'placeholder' => 'Make']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('model', 'Model') !!}
        {!! Form::text('model', null, ['class' => 'form-control', 'id' => 'model', 'placeholder' => 'Model']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('registration_number', 'Registration number') !!}
        {!! Form::text('registration_number', null, ['class' => 'form-control', 'id' => 'registration_number', 'placeholder' => 'Registration number']) !!}
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
        {!! Form::label('car_types', 'Car type') !!}
        {!! Form::select('car_types[]', $oCarTypes,($oRentalCar)?$oRentalCar->types()->pluck('car_type_id')->toArray():null,array('class'=>'form-control', 'multiple'=>'true','id'=>'car_types')) !!}
    </div>
</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! $submit_button !!}</button>
</div>
{!! Form::close() !!}