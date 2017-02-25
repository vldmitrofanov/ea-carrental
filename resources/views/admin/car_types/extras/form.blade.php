<div class="box-body">
    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
    </div>
    <div class="form-group">
        <label style="display: block" for="price">Price</label>
        {!! Form::text('price', null, ['class' => 'form-control', 'style' => 'float: left;width: 40%;', 'id' => 'price', 'placeholder' => 'Price']) !!}
        {!! Form::select('per', array('booking'=>'Per reservation', 'day'=>'Per day'),null,array('class'=>'form-control','style' => 'margin-left:10px;float: left;width: 50%;','id'=>'per')) !!}
    </div>
    <div class="form-group" style=" clear: both;padding-top: 5px;">
        {!! Form::label('type', 'Type') !!}
        {!! Form::select('type', array('single'=>'Single', 'multi'=>'Multi'),null,array('class'=>'form-control','id'=>'type')) !!}
    </div>

    
</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary">{!! $submit_button !!}</button>
</div>
{!! Form::close() !!}