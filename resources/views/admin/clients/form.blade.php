<div class="box-body">
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::select('title', array(''=>'Please Select')+config('settings.user_title'),null,array('class'=>'form-control','id'=>'title')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('username', 'User Name') !!}
        {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username', 'placeholder' => 'User Name']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password', 'placeholder' => 'Password']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('phone', 'Phone') !!}
        {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('company_name', 'Company Name') !!}
        {!! Form::text('company_name', null, ['class' => 'form-control', 'id' => 'company_name', 'placeholder' => 'Company Name']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('address', 'Address') !!}
        {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) !!}
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
        {!! Form::label('zip', 'Zip') !!}
        {!! Form::text('zip', null, ['class' => 'form-control', 'id' => 'zip', 'placeholder' => 'Zip']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('country_id', 'Country') !!}
        {!! Form::select('country_id', array(''=>'Please Select')+$oCountries,null,array('class'=>'form-control','id'=>'country_id')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role') !!}
        <select class="form-control" id="role_id" name="role_id">
            @foreach($oRoles as $oRole)
                <option value="{{ $oRole->id }}" {{  ($oUser && $oUser->hasRole($oRole->name))?'selected':'' }} >{{ $oRole->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        {!! Form::label('status', 'Status') !!}
        {!! Form::select('status', array('1'=>'Active', '0' => 'Inactive'),null,array('class'=>'form-control','id'=>'status')) !!}
    </div>
</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! $submit_button !!}</button>
</div>
{!! Form::close() !!}