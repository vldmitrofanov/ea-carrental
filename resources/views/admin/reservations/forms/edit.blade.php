<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#details" data-toggle="tab">Rental Details</a></li>
        <li><a href="#customer" data-toggle="tab">Customer Details</a></li>
        <li><a href="#pickup" data-toggle="tab">Pick Up</a></li>
        <li><a href="#return" data-toggle="tab">Return</a></li>
        <li><a href="#payments" data-toggle="tab">Payments</a></li>
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
                            <option value="confirmed" {{  ($oReservation->status=='confirmed')?'selected':'' }}>Confirmed</option>
                            <option value="pending" {{  ($oReservation->status=='pending')?'selected':'' }}>Pending</option>
                            <option value="cancelled" {{  ($oReservation->status=='cancelled')?'selected':'' }}>Cancelled</option>
                            <option value="collected" {{  ($oReservation->status=='collected')?'selected':'' }}>Collected</option>
                            <option value="completed" {{  ($oReservation->status=='completed')?'selected':'' }}>Completed</option>
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
                            {!! Form::text('date_from', $oReservation->details->first()->date_from, ['class' => 'form-control', 'id' => 'date_from', 'placeholder' => 'Date From']) !!}
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
                            {!! Form::text('date_to', $oReservation->details->first()->date_to, ['class' => 'form-control', 'id' => 'date_to', 'placeholder' => 'Date To']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="car_type_id" class="col-sm-2 control-label">Car Type</label>
                    <div class="col-sm-10">
                        {!! Form::select('car_type_id', array(''=>'Please Select')+$oCarTypes,$oReservation->details->first()->carType->id,array('class'=>'form-control','id'=>'car_type_id')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="car_id" class="col-sm-2 control-label">Car</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="car_id" name="car_id">
                            <option value="">Please Select</option>
                            @foreach($oCars as $oCar)
                                <option value="{{ $oCar->id  }}" {{ ($oReservation->details->first()->car_id==$oCar->id)?'selected':''  }} >{{ $oCar->make  }} {{ $oCar->model }} - {{  $oCar->registration_number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pickup_location_id" class="col-sm-2 control-label">Pick-up Location</label>
                    <div class="col-sm-10">
                        {!! Form::select('pickup_location_id', array(''=>'Please Select')+$oOfficeLocations,$oReservation->details->first()->pickup_location_id,array('class'=>'form-control','id'=>'pickup_location_id')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="pickup_near_location" class="col-sm-2 control-label">Pick-up Location &nbsp;&nbsp;<img src="{{asset('images/help.png') }}" class="protip" data-pt-title="In case of different pick-up location, please mention." width="14"></label>
                    <div class="col-sm-10">
                        {!! Form::text('pickup_near_location', $oReservation->details->first()->pickup_near_location, ['class' => 'form-control', 'id' => 'pickup_near_location', 'placeholder' => 'Near by Pick up Location']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="return_location_id" class="col-sm-2 control-label">Return Location</label>
                    <div class="col-sm-10">
                        {!! Form::select('return_location_id', array(''=>'Please Select')+$oOfficeLocations,$oReservation->details->first()->return_location_id,array('class'=>'form-control','id'=>'return_location_id')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="return_near_location" class="col-sm-2 control-label">Return Location &nbsp;&nbsp;<img src="{{asset('images/help.png') }}" class="protip" data-pt-title="In case of different return location, please mention." width="14"></label>
                    <div class="col-sm-10">
                        {!! Form::text('return_near_location', $oReservation->details->first()->return_return_location, ['class' => 'form-control', 'id' => 'return_near_location', 'placeholder' => 'Near by Return Location']) !!}
                    </div>
                </div>

                <div class="form-group">
                <table class="table extras-table">
                    <tbody>
                    @foreach($oReservation->extras as $oExtra)
                    <tr id="{{$oExtra->id}}">
                        <td>
                            <div class="form-group"><label class="col-sm-2 control-label"></label>
                                <div class="col-sm-4"><select class="form-control" onchange="addExtra(this)"
                                                              name="extra_id[{{$oExtra->id}}]"
                                                              id="extra_id_{{$oExtra->id}}">
                                        <option value="">Choose Extra</option>
                                        @foreach($oExtras as $extra)
                                        <option {{  ($oExtra->extra_id==$extra->id)?'selected':'' }} data-currency="{{$currencySign}}" data-per="{{$extra->per}}" data-price="{{$extra->price}}" value="{{$extra->id}}">{{$extra->name}}</option>
                                        @endforeach
                                    </select></div>
                                <div class="col-sm-3"><select class="form-control" onchange="addExtra(this)"
                                                              name="extra_cnt[{{$oExtra->id}}]"
                                                              id="extra_cnt_{{$oExtra->id}}">
                                        @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{$i}}" {{  ($oExtra->quantity==$i)?'selected':'' }}>{{$i}}</option>
                                        @endfor
                                    </select></div>
                                <div class="col-sm-2"><a href="javascript:;" class="remove-extra"
                                                         data-id="{{$oExtra->id}}"><i class="fa fa-trash"
                                                                                    style="padding-top: 8px;"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary add-extra"> <i class="fa fa-plus"></i> Add Extra</button>
                        <button type="button" class="btn btn-success save-reservation">Submit</button>

                        <a href="{{  url('admin/reservations/'.$oReservation->id.'/invoice') }}" target="_blank" class="btn btn-primary btn-pdf">
                            <i class="fa fa-download"></i> Generate Invoice
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <table class="table payment_detail">
                    <tbody>
                    <tr>
                        <th style="width:50%">Rental Duration:</th>
                        <td>{{ $oReservation->details->first()->rental_days }} Days and {{$oReservation->details->first()->rental_horus}} Hours</td>
                    </tr>
                    <tr>
                        <th>Price per day:<br/>{{ $oReservation->details->first()->price_per_day_detail }}</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->price_per_day }}</td>
                    </tr>
                    <tr>
                        <th>Discount:<br/>{{ $oReservation->details->first()->discount_detail }}</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->discount }}</td>
                    </tr>
                    <tr>
                        <th>Price per hour:<br/>{{ $oReservation->details->first()->price_per_hour_detail }}</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->price_per_hour }}</td>
                    </tr>
                    <tr>
                        <th>Car rental fee:</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->car_rental_fee }}</td>
                    </tr>
                    <tr>
                        <th>Extras Price:</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->extra_price }}</td>
                    </tr>
                    <tr>
                        <th>Insurance:</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->insurance }}</td>
                    </tr>
                    <tr>
                        <th>Sub-total:</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->sub_total }}</td>
                    </tr>
                    <tr>
                        <th>Tax:</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->tax }}</td>
                    </tr>
                    <tr>
                        <th class="text-red">Total Price:</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->total_price }}</td>
                    </tr>
                    <tr>
                        <th>Required deposit:</th>
                        <td>{{$currencySign}} {{ $oReservation->details->first()->required_deposit }}</td>
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
                    {!! Form::select('title', array(''=>'Please Select')+config('settings.user_title'),$oReservation->user->title,array('class'=>'form-control','id'=>'title')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    {!! Form::text('name', $oReservation->user->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Customer Name']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        {!! Form::text('email', $oReservation->user->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Customer Email']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        {!! Form::text('phone', $oReservation->user->phone, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Customer Phone']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="company_name" class="col-sm-2 control-label">Company Name</label>
                <div class="col-sm-10">
                    {!! Form::text('company_name', $oReservation->user->company_name, ['class' => 'form-control', 'id' => 'company_name', 'placeholder' => 'Company Name']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    {!! Form::text('address', $oReservation->user->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Customer Address']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    {!! Form::text('state', $oReservation->user->state, ['class' => 'form-control', 'id' => 'state', 'placeholder' => 'Customer State']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    {!! Form::text('city', $oReservation->user->city, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Customer City']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="zip" class="col-sm-2 control-label">Zip</label>
                <div class="col-sm-10">
                    {!! Form::text('zip', $oReservation->user->zip, ['class' => 'form-control', 'id' => 'zip', 'placeholder' => 'Zip Code']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="country_id" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                    {!! Form::select('country_id', array(''=>'Please Select')+$oCountries,$oReservation->user->country_id,array('class'=>'form-control','id'=>'country_id')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="cc_type" class="col-sm-2 control-label">Credit card type</label>
                <div class="col-sm-10">
                    {!! Form::select('cc_type', array(''=>'Please Select')+config('settings.cc_types'),$oReservation->cc_type,array('class'=>'form-control','id'=>'cc_type')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="cc_number" class="col-sm-2 control-label">Credit card number</label>
                <div class="col-sm-10">
                    {!! Form::text('cc_number', $oReservation->cc_num, ['class' => 'form-control', 'id' => 'cc_number', 'placeholder' => 'Credit card number']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="cc_expiration" class="col-sm-2 control-label">Credit card expiration</label>
                <div class="col-sm-10">
                    {!! Form::text('cc_expiration', $oReservation->cc_exp, ['class' => 'form-control', 'id' => 'cc_expiration', 'placeholder' => 'Credit card expiration']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="cc_code" class="col-sm-2 control-label">Credit card code</label>
                <div class="col-sm-10">
                    {!! Form::text('cc_code', $oReservation->cc_code, ['class' => 'form-control', 'id' => 'cc_code', 'placeholder' => 'Credit card code']) !!}
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="passport">ID/IC/Passport</label>
                <div class="col-sm-10">
                    <div id="filename"></div>
                    <div id="progress"></div>
                    <div id="progressBar"></div>
                    
                <input type="file" class="form-control" style="border:none;" name="passport">
                @if($oReservation->user->passport())
                <p class="help-block"><a target="_blank" href="{{$oReservation->user->passport()}}">Download ID/IC/Passport</a></p>
                @endif
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="licence">Driver Licence</label>
                <div class="col-sm-10">
                <input type="file" class="form-control" style="border:none;" name="licence">
                
                @if($oReservation->user->licence())
                    <p class="help-block"><a target="_blank" href="{{$oReservation->user->licence()}}">Download Driver Licence</a></p>
                @endif
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="rental_form">Rental Form</label>
                <div class="col-sm-10">
                <input type="file" class="form-control" style="border:none;" name="rental_form">

                @if($oReservation->user->rentalForm())
                    <p class="help-block"><a target="_blank" href="{{$oReservation->user->rentalForm()}}">Download Rental Form</a></p>
                @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success save-reservation">Submit</button>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="pickup">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Pick-up information!</h4>
                Fill in the form below when client collects the car. You can enter exact date and time when car is picked up and also the current mileage for the car being rented. It will be used when car is returned to calculate exact rental period and if there is extra mileage.
            </div>
            <div class="form-group">
                <label for="pickup_date" class="col-sm-3 control-label">Pick-up Date and Time</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        {!! Form::text('pickup_date', $oReservation->details->first()->pickup_date, ['class' => 'form-control', 'id' => 'pickup_date', 'placeholder' => 'Pickup Date']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="collected_car_id" class="col-sm-3 control-label">Collected Car</label>
                <div class="col-sm-9">
                    <select class="form-control" id="collected_car_id" name="collected_car_id">
                        <option value="">Please Select</option>
                        @foreach($oCars as $oCar)
                            <option value="{{ $oCar->id  }}" {{ ($oReservation->details->first()->car_id==$oCar->id)?'selected':''  }} >{{ $oCar->make  }} {{ $oCar->model }} - {{  $oCar->registration_number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Current Mileage</label>
                <div class="col-sm-9" style="margin-top:8px;">
                    {{$oReservation->details->first()->car->current_mileage}} {{$settingsArr['mileage']}}
                </div>
            </div>

            <div class="form-group">
                <label for="pickup_mileage" class="col-sm-3 control-label">Pick-up Mileage (@/{{$settingsArr['mileage']}})</label>
                <div class="col-sm-9">
                    {!! Form::text('pickup_mileage',$oReservation->details->first()->pickup_mileage, ['class' => 'form-control', 'id' => 'pickup_mileage', 'placeholder' => 'Pick-up Mileage', 'style'=>'width:180px;display:inline;']) !!}
                    <a href="javascript:;" class="set-mileage" data-mileage="{{$oReservation->details->first()->car->current_mileage}}">(set same as current mileage)</a>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="button" class="btn btn-success save-reservation">Submit</button>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="return">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i>Return information!</h4>
                Fill in the form below when client returns the car. Based on the return time entered the system will calculate if return is delayed. Enter car mileage on return and extra mileage fee will be automatically calculated.
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Return Deadline</label>
                <div class="col-sm-9" style="margin-top:8px;">
                    {{ $oReservation->details->first()->date_to }}
                </div>
            </div>
            <div class="form-group">
                <label for="return_date" class="col-sm-3 control-label">Return Date & Time</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        {!! Form::text('return_date', $oReservation->details->first()->return_date, ['class' => 'form-control', 'id' => 'return_date', 'placeholder' => 'Return Date']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Extra hours usage</label>
                <div class="col-sm-9 extra-hours-usage" style="margin-top:8px;">
                    No
                </div>
            </div>

            <div class="form-group">
                <label for="return_mileage" class="col-sm-3 control-label">Return mileage (@/{{$settingsArr['mileage']}})</label>
                <div class="col-sm-9">
                    {!! Form::text('return_mileage',$oReservation->details->first()->return_mileage, ['class' => 'form-control', 'id' => 'return_mileage', 'placeholder' => 'Return Mileage']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success save-reservation">Submit</button>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="payments">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i>Payments Log!</h4>
                Use the list below to add all payments made by your client for their reservation. You can add different types of payments and payment methods. All amounts in the Information box are automatically calculated based on the payments you add. When you return a security deposit, collected for the reservation, to your client add a 'Security deposit returned' payment and it will deducted from the 'Payments Made' amount.
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Total Price <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="The total reservation price as calculated on Rental Details tab.."></label>
                <div class="col-sm-9 lbl-total-price" style="margin-top:8px;">
                    {{  $currencySign }} {{ $oReservation->details->first()->total_price }}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Payments Made <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="A summary of all payments entered below (with status 'paid')."></label>
                <div class="col-sm-9 payment-made" style="margin-top:8px;">
                    @if($oReservation->payments->where('status','paid')->sum('amount'))
                    {{  $currencySign }} {{ $oReservation->payments->where('status','paid')->sum('amount') }}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Payment Due <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="Calculates the margin between 'Total Price' and all 'Payments Made' amount."></label>
                <div class="col-sm-9 payment-due" style="margin-top:8px;">
                    @if($oReservation->details->first()->total_price - $oReservation->payments->where('status','paid')->sum('amount')>0)
                        {{  $currencySign }} {{ $oReservation->details->first()->total_price - $oReservation->payments->where('status','paid')->sum('amount') }}
                    @else
                        {{  $currencySign }} 0
                    @endif
                </div>
            </div>

            <table class="table table-bordered payments">
                <thead>
                <tr>
                    <th>Payment Method</th>
                    <th>Payment type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th style="width: 40px"></th>
                </tr>
                </thead>

                <tbody>
                    @foreach($oReservation->payments as $oPayment)
                        <tr id="{{$oPayment->id}}">
                            <td><select class="form-control" name="payment_method[{{$oPayment->id}}]">
                                    <option value="paypal" {{($oPayment->payment_method=='paypal')?'selected':''}}>Paypal</option>
                                    <option value="authorize" {{($oPayment->payment_method=='authorize')?'selected':''}}>Authorize.net</option>
                                    <option value="creditcard" {{($oPayment->payment_method=='creditcard')?'selected':''}}>Credit Card</option>
                                    <option value="bank" {{($oPayment->payment_method=='bank')?'selected':''}}>Bank</option>
                                    <option value="cash" {{($oPayment->payment_method=='cash')?'selected':''}}>Cash</option>
                                </select></td>
                            <td><select class="form-control" name="payment_type[{{$oPayment->id}}]">
                                    <option value="online" {{($oPayment->payment_type=='online')?'selected':''}}>Online booking</option>
                                    <option value="balance" {{($oPayment->payment_type=='balance')?'selected':''}}>Payment</option>
                                    <option value="securitypaid" {{($oPayment->payment_type=='securitypaid')?'selected':''}}>Security deposit paid</option>
                                    <option value="securityreturned" {{($oPayment->payment_type=='securityreturned')?'selected':''}}>Security deposit returned</option>
                                    <option value="delay" {{($oPayment->payment_type=='delay')?'selected':''}}>Delay fee</option>
                                    <option value="extra" {{($oPayment->payment_type=='extra')?'selected':''}}>Extra mileage</option>
                                    <option value="additional" {{($oPayment->payment_type=='additional')?'selected':''}}>Additional charges</option>
                                </select></td>
                            <td><input class="form-control" name="payment_amount[{{$oPayment->id}}]" value="{{ $oPayment->amount  }}"></td>
                            <td><select class="form-control" name="payment_status[{{$oPayment->id}}]">
                                    <option value="paid" {{($oPayment->status=='paid')?'selected':''}}>Paid</option>
                                    <option value="notpaid" {{($oPayment->status=='notpaid')?'selected':''}}>Not paid</option>
                                </select></td>
                            <td><a href="javascript:;" class="remove-payment" data-id="{{$oPayment->id}}"><i
                                            class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-info btn-add-payment">Add Payment+</button>
                    <button type="button" class="btn btn-success save-reservation">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}