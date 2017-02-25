<div class="box-body">
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        <div class="input-group">
            <span class="input-group-addon">@</span>
            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('notify_email', 'Email notifications') !!}
        <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="Send New reservation, Payment confirmation, and Reservation Cancellation email notifications to this email address.">
        <div class="">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="notify_email" id="notify_email"> Email notifications
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('phone', 'Phone') !!}
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('country_id', 'Country') !!}
        {!! Form::select('country_id', array(''=>'Please Select')+$oCountries,null,array('class'=>'form-control','id'=>'country_id')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('state', 'State') !!}
        {!! Form::text('state', null, ['class' => 'form-control', 'id' => 'state', 'placeholder' => 'State']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('city', 'City') !!}
        {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'City']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('address', 'Address') !!}
        {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('zip', 'Zip') !!}
        {!! Form::text('zip', null, ['class' => 'form-control', 'id' => 'zip', 'placeholder' => 'Zip']) !!}
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-info">Find on Map</button>
    </div>
    <div class="form-group">
        {!! Form::label('lat', 'Latitude') !!}
        {!! Form::text('lat', null, ['class' => 'form-control', 'id' => 'lat', 'placeholder' => 'Latitude']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('lng', 'Longitude') !!}
        {!! Form::text('lng', null, ['class' => 'form-control', 'id' => 'lng', 'placeholder' => 'Longitude']) !!}
    </div>

    <div class="form-group">
        <label for="exampleInputFile">Image</label>
        <input name="thumb_image" type="file">
    </div>



</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! $submit_button !!}</button>
</div>
{!! Form::close() !!}