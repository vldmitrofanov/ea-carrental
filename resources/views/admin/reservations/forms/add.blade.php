<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#details" data-toggle="tab">Rental Details</a></li>
        <li><a href="#customer" data-toggle="tab">Customer Details</a></li>
    </ul>

    <div class="tab-content">

        <div id="details" class="tab-pane active">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Rental details!</h4>
                In the Rental Details box below you can add details about the reservation - start and end date/time, car type, pick-up and return locations. As soon as you select car type the price for the selected rental period will be automatically calculated in the Price box. Use the Extras box at the bottom to add additional extras to the reservation. Their price will also be included in the total rental price.
            </div>
            <div class="row">
            <div class="col-md-8 reservation-fields">
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" id="status" class="form-control">
                            <option value="">-- Choose --</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="pending">Pending</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="collected">Collected</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_from" class="col-sm-2 control-label">From</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            {!! Form::text('date_from', null, ['class' => 'form-control', 'id' => 'date_from', 'placeholder' => 'Date From']) !!}
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
                <div class="form-group">
                    <label for="car_type_id" class="col-sm-2 control-label">Car Type</label>
                    <div class="col-sm-10">
                        {!! Form::select('car_type_id', array(''=>'Please Select')+$oCarTypes,null,array('class'=>'form-control','id'=>'car_type_id')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="car_id" class="col-sm-2 control-label">Car</label>
                    <div class="col-sm-10">
                        {!! Form::select('car_id', array(''=>'Please Select'),null,array('class'=>'form-control','id'=>'car_id')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="pickup_location_id" class="col-sm-2 control-label">Pick-up Location</label>
                    <div class="col-sm-10">
                        {!! Form::select('pickup_location_id', array(''=>'Please Select')+$oOfficeLocations,null,array('class'=>'form-control','id'=>'pickup_location_id')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="pickup_near_location" class="col-sm-2 control-label">Pick-up Location &nbsp;&nbsp;<img src="{{asset('images/help.png') }}" class="protip" data-pt-title="In case of different pick-up location, please mention." width="14"></label>
                    <div class="col-sm-10">
                        {!! Form::text('pickup_near_location', null, ['class' => 'form-control', 'id' => 'pickup_near_location', 'placeholder' => 'Near by Pick up Location']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="return_location_id" class="col-sm-2 control-label">Return Location</label>
                    <div class="col-sm-10">
                        {!! Form::select('return_location_id', array(''=>'Please Select')+$oOfficeLocations,null,array('class'=>'form-control','id'=>'return_location_id')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="return_near_location" class="col-sm-2 control-label">Return Location &nbsp;&nbsp;<img src="{{asset('images/help.png') }}" class="protip" data-pt-title="In case of different return location, please mention." width="14"></label>
                    <div class="col-sm-10">
                        {!! Form::text('return_near_location', null, ['class' => 'form-control', 'id' => 'return_near_location', 'placeholder' => 'Near by Return Location']) !!}
                    </div>
                </div>

                <div class="form-group">
                <table class="table extras-table">
                    <tbody></tbody>
                </table>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary add-extra"> <i class="fa fa-plus"></i> Add Extra</button>
                        <button type="button" class="btn btn-success save-reservation">Submit</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <table class="table payment_detail">
                    <tbody>
                    <tr>
                        <th style="width:50%">Rental Duration:</th>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th>Price per day</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Discount:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Price per hour:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Car rental fee:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Extras Price:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Insurance:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Sub-total:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Tax:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th class="text-red">Total Price:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Required deposit:</th>
                        <td>0</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </div>
        </div>


        <div class="tab-pane" id="customer">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Customer Details!</h4>
                Enter customer details in the form below.
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    {!! Form::select('title', array(''=>'Please Select')+config('settings.user_title'),null,array('class'=>'form-control','id'=>'title')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Customer Name']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Customer Email']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Customer Phone']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="company_name" class="col-sm-2 control-label">Company Name</label>
                <div class="col-sm-10">
                    {!! Form::text('company_name', null, ['class' => 'form-control', 'id' => 'company_name', 'placeholder' => 'Company Name']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Customer Address']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    {!! Form::text('state', null, ['class' => 'form-control', 'id' => 'state', 'placeholder' => 'Customer State']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Customer City']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="zip" class="col-sm-2 control-label">Zip</label>
                <div class="col-sm-10">
                    {!! Form::text('zip', null, ['class' => 'form-control', 'id' => 'zip', 'placeholder' => 'Zip Code']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="country_id" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                    {!! Form::select('country_id', array(''=>'Please Select')+$oCountries,null,array('class'=>'form-control','id'=>'country_id')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="cc_type" class="col-sm-2 control-label">Credit card type</label>
                <div class="col-sm-10">
                    {!! Form::select('cc_type', array(''=>'Please Select')+config('settings.cc_types'),null,array('class'=>'form-control','id'=>'cc_type')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="cc_number" class="col-sm-2 control-label">Credit card number</label>
                <div class="col-sm-10">
                    {!! Form::text('cc_number', null, ['class' => 'form-control', 'id' => 'cc_number', 'placeholder' => 'Credit card number']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="cc_expiration" class="col-sm-2 control-label">Credit card expiration</label>
                <div class="col-sm-10">
                    {!! Form::text('cc_expiration', null, ['class' => 'form-control', 'id' => 'cc_expiration', 'placeholder' => 'Credit card expiration']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="cc_code" class="col-sm-2 control-label">Credit card code</label>
                <div class="col-sm-10">
                    {!! Form::text('cc_code', null, ['class' => 'form-control', 'id' => 'cc_code', 'placeholder' => 'Credit card code']) !!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success save-reservation">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}