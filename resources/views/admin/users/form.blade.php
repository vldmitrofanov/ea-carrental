<div class="box-body">
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
        {!! Form::label('role_id', 'Role') !!}
        <select class="form-control" id="role_id" name="role_id">
            <option value="" selected="selected">Please Select</option>
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