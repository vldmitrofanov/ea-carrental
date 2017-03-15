<div class="nav-tabs-custom">
    <div class="tab-content">
        <div id="details" class="tab-pane active">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Email Subject</label>
                <div class="col-sm-10">
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Email Subject']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="email_body" class="col-sm-2 control-label">Email Message</label>
                <div class="col-sm-10">
                {!! Form::textarea('email_body', null, ['class' => 'form-control', 'id' => 'email_body', 'placeholder' => 'Email body Content']) !!}
                </div>
            </div>            

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">{{ $submit_button}}</button>
                </div>
            </div>

        </div>
    </div>
</div>
{!! Form::close() !!}