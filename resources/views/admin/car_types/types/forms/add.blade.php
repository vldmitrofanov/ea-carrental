<div class="box-body">
    <div class="form-group">
        {!! Form::label('name', 'Type') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Type']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Type Description']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('price_per_day', 'Price per day') !!}
        <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="This is the default daily price for renting this car type. Later when you add the car type you can specify custom seasonal prices.">
        {!! Form::text('price_per_day', null, ['class' => 'form-control', 'id' => 'price_per_day', 'placeholder' => 'Price per Day']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('price_per_hour', 'Price per hour') !!}
        <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="This is the default hourly price for renting this car type. Later when you add the car type you can specify custom seasonal prices.">
        {!! Form::text('price_per_hour', null, ['class' => 'form-control', 'id' => 'price_per_hour', 'placeholder' => 'Price per hour']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('limit_mileage', 'Limit mileage (per km)') !!}
        <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="Set allowed daily mileage. Customers that extend this will be charged additional fee as per the amount you enter in the next box.">
        {!! Form::text('limit_mileage', null, ['class' => 'form-control', 'id' => 'limit_mileage', 'placeholder' => 'Limit mileage']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('extra_mileage', 'Price for extra mileage (per km)') !!}
        <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="Set price for each km/mile over the allowed daily mileage limit.">
        {!! Form::text('extra_mileage', null, ['class' => 'form-control', 'id' => 'extra_mileage', 'placeholder' => 'Price for extra mileage']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('total_passengers', 'Num. of passengers') !!}
        {!! Form::text('total_passengers', null, ['class' => 'form-control', 'id' => 'total_passengers', 'placeholder' => 'Num. of passengers']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('total_bags', 'Pieces of bags') !!}
        {!! Form::text('total_bags', null, ['class' => 'form-control', 'id' => 'total_bags', 'placeholder' => 'Pieces of bags']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('total_doors', 'Number of doors') !!}
        {!! Form::text('total_doors', null, ['class' => 'form-control', 'id' => 'total_doors', 'placeholder' => 'Number of doors']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('transmission', 'Transmission') !!}
        {!! Form::select('transmission', array('Manual'=>'Manual', 'Automatic'=>'Automatic', 'Semi-automatic'=>'Semi-automatic'),null,array('class'=>'form-control','id'=>'transmission')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('available_extras', 'Available Extras') !!}
        {!! Form::select('available_extras[]', array(''=>'Please Select')+$oExtras,null,array('class'=>'form-control', 'multiple'=>'true','id'=>'transmission')) !!}
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <input name="type_image" type="file">
    </div>



</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! $submit_button !!}</button>
</div>
{!! Form::close() !!}