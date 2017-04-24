<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#options" data-toggle="tab">Options</a></li>
        <li><a href="#rental" data-toggle="tab">Rental Settings</a></li>
        <li><a href="#payments" data-toggle="tab">Payments</a></li>
        <li><a href="#notifications" data-toggle="tab">Notifications</a></li>
    </ul>

    <div class="tab-content">

        <div id="options" class="tab-pane active">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> General options!</h4>
                Here you can set the Car Rental System general settings.
            </div>

            <div class="form-group">
                <label for="car_id" class="col-sm-2 control-label">Currency</label>
                <div class="col-sm-10">
                    <select class="form-control" id="currency" name="data[currency]">
                        @foreach($oCurrencies as $oCurrency)
                            <option {{ ($oSettings->where('key','currency')->first() && $oSettings->where('key','currency')->first()->value==$oCurrency->currency_code)?'selected':'' }} value="{{ $oCurrency->currency_code  }}">{{ $oCurrency->currency_name  }} - {{ $oCurrency->currency_code  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="mileage" class="col-sm-2 control-label">Mileage units</label>
                <div class="col-sm-10">
                {!! Form::select('data[mileage]', array('km'=>'km', 'mile' => 'mile'), ($oSettings->where('key','mileage')->first())?$oSettings->where('key','mileage')->first()->value:'null',array('class'=>'form-control','id'=>'mileage')) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="week_start" class="col-sm-2 control-label">First day of the week</label>
                <div class="col-sm-10">
                {!! Form::select('data[week_start]', config('settings.week_days'),($oSettings->where('key','week_start')->first())?$oSettings->where('key','week_start')->first()->value:'null', array('class'=>'form-control','id'=>'week_start')) !!}
                </div>
            </div>

            <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </div>

        <div class="tab-pane" id="rental">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Rental Settings!</h4>
                On this page you can set car rental settings related to how price is being calculated for each reservation. You can choose between 3 types of rental prices: daily, hourly or both daily and hourly. Here is an example if clients rents a car for 1 day and 6 hours. If 'Calculate rental fee' option is set to 'Per day only', then depending on 'Free of charge tolerance' setting the system will calculate the price based on 1 day or 2 days daily prices. If 'Per hour only' is chosen then the system will calculate the price based on 30 hours car usage. If 'Per day and per hour' is chosen then the price will be calculated for 1 day and 6 hours. You can set rates for each car type under Edit Car type page. Please, pay attention when you fill in daily and hourly rates for car types, especially if you have set the system to 'Per day and per hour'. In any of the 3 cases, the system will let clients select their pick-up and return time. So if the system is set to 'Per day only' rental fee then you can manage how the system will calculate the 'extra hours' for each reservation through 'Free of charge tolerance' option.
            </div>
            <div class="form-group">
                <label for="calculate_rental_fee" class="col-sm-3 control-label">Calculate rental fee &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title=" Set how the system should calculate the price for each reservation."></label>
                <div class="col-sm-9">
                    {!! Form::select('data[calculate_rental_fee]', config('settings.calculate_rental_fee'),($oSettings->where('key','calculate_rental_fee')->first())?$oSettings->where('key','calculate_rental_fee')->first()->value:'null',array('class'=>'form-control','id'=>'rental_fee')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="minimum_booking_length" class="col-sm-3 control-label">Min. booking length &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title=" Users will not be able to rent a car for less time than set here."></label>
                <div class="col-sm-9">
                    {!! Form::number('data[minimum_booking_length]', ($oSettings->where('key','minimum_booking_length')->first())?$oSettings->where('key','minimum_booking_length')->first()->value:'null', ['class' => 'form-control', 'id' => 'minimum_booking_length', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}&nbsp;	hour(s)
                </div>
            </div>
            <div class="form-group">
                <label for="booking_pending" class="col-sm-3 control-label">Car 'On hold' while pending &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="  A specific car is assigned to each new reservation. If reservation is not confirmed within X hours then this car will be available for booking again for the same date and time."></label>
                <div class="col-sm-9">
                    {!! Form::number('data[booking_pending]', ($oSettings->where('key','booking_pending')->first())?$oSettings->where('key','booking_pending')->first()->value:'null', ['class' => 'form-control', 'id' => 'booking_pending', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}&nbsp;	hour(s)
                </div>
            </div>
            <div class="form-group">
                <label for="rental_terms" class="col-sm-3 control-label">Rental terms</label>
                <div class="col-sm-9">
                    {!! Form::textarea('data[rental_terms]',($oSettings->where('key','rental_terms')->first())?$oSettings->where('key','rental_terms')->first()->value:'null',['class'=>'form-control', 'id' => 'rental_terms']) !!}
                </div>
            </div>



            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="payments">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Payment Options!</h4>
                Here you can choose your payment methods and set payment gateway accounts and payment preferences. Note that for cash payments the system will not be able to collect deposit amount online.
            </div>
            <div class="form-group">
                <label for="deposit_payment" class="col-sm-3 control-label">Deposit payment &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="  Set flat amount or % of total price."></label>
                <div class="col-sm-9">
                    {!! Form::number('data[deposit_payment]', ($oSettings->where('key','deposit_payment')->first())?$oSettings->where('key','deposit_payment')->first()->value:'null', ['class' => 'form-control', 'id' => 'deposit_payment', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}&nbsp;

                    {!! Form::select('data[deposit_type]', config('settings.deposit_type'),($oSettings->where('key','deposit_type')->first())?$oSettings->where('key','deposit_type')->first()->value:'null',array('class'=>'form-control','id'=>'deposit_type', 'style' => 'width:180px; display:inline')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="deposit_payment" class="col-sm-3 control-label">Tax payment &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title=" If there is no tax for payments, just enter 0. You can also add a fixed tax value or % of the total price. "></label>
                <div class="col-sm-9">
                    {!! Form::number('data[tax_payment]', ($oSettings->where('key','tax_payment')->first())?$oSettings->where('key','tax_payment')->first()->value:'null', ['class' => 'form-control', 'id' => 'tax_payment', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}&nbsp;

                    {!! Form::select('data[tax_type]', config('settings.tax_type'),($oSettings->where('key','tax_type')->first())?$oSettings->where('key','tax_type')->first()->value:'null',array('class'=>'form-control','id'=>'tax_type', 'style' => 'width:180px; display:inline')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="service_tax_payment" class="col-sm-3 control-label">Service payment &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title=" If there is no tax for payments, just enter 0. You can also add a fixed tax value or % of the total price. "></label>
                <div class="col-sm-9">
                    {!! Form::number('data[service_tax_payment]', ($oSettings->where('key','service_tax_payment')->first())?$oSettings->where('key','service_tax_payment')->first()->value:'null', ['class' => 'form-control', 'id' => 'service_tax_payment', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}&nbsp;

                    {!! Form::select('data[service_tax_type]', config('settings.service_tax_type'),($oSettings->where('key','service_tax_type')->first())?$oSettings->where('key','service_tax_type')->first()->value:'null',array('class'=>'form-control','id'=>'service_tax_type', 'style' => 'width:180px; display:inline')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="security_payment" class="col-sm-3 control-label">Security payment &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title=" The system does not calculate the Security payment in the Deposit payment amount or the Total rental price. It will be used for defining reservation payments for each reservation that you can manage on Payments tab while editing a reservation."></label>
                <div class="col-sm-9">
                    {!! Form::number('data[security_payment]', ($oSettings->where('key','security_payment')->first())?$oSettings->where('key','security_payment')->first()->value:'0', ['class' => 'form-control', 'id' => 'security_payment', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}&nbsp;
                </div>
            </div>
            <div class="form-group">
                <label for="insurance_payment" class="col-sm-3 control-label">Insurance payment &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title=" Add an insurance fee for each booking or just leave it 0. You can choose if the fee is per day, per reservation or percentage of the rental amount. "></label>
                <div class="col-sm-9">
                    {!! Form::number('data[insurance_payment]', ($oSettings->where('key','insurance_payment')->first())?$oSettings->where('key','insurance_payment')->first()->value:'0', ['class' => 'form-control', 'id' => 'insurance_payment', 'min' => '0', 'style' => 'width:180px; display:inline']) !!}&nbsp;

                    {!! Form::select('data[insurance_type]', config('settings.insurance_type'),($oSettings->where('key','insurance_type')->first())?$oSettings->where('key','insurance_type')->first()->value:'null',array('class'=>'form-control','id'=>'insurance_type', 'style' => 'width:180px; display:inline')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="booking_status" class="col-sm-3 control-label">Booking status if not paid &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="  Set what the default reservation status should be, if payment hasn't been made. "></label>
                <div class="col-sm-9">
                    {!! Form::select('data[booking_status]', config('settings.booking_status'),($oSettings->where('key','booking_status')->first())?$oSettings->where('key','booking_status')->first()->value:'null',array('class'=>'form-control','id'=>'booking_status', 'style' => 'width:180px; display:inline')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="payment_status" class="col-sm-3 control-label">Booking status if paid &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title=" Set what the default reservation status should be, if payment has been made."></label>
                <div class="col-sm-9">
                    {!! Form::select('data[payment_status]', config('settings.payment_status'),($oSettings->where('key','payment_status')->first())?$oSettings->where('key','payment_status')->first()->value:'null',array('class'=>'form-control','id'=>'payment_status', 'style' => 'width:180px; display:inline')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="payment_disable" class="col-sm-3 control-label">Disable payments &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title=" You can disable online payments and only accept bookings."></label>
                <div class="col-sm-9">
                    {!! Form::select('data[payment_disable]', config('settings.payment_disable'),($oSettings->where('key','payment_disable')->first())?$oSettings->where('key','payment_disable')->first()->value:'null',array('class'=>'form-control','id'=>'payment_disable', 'style' => 'width:180px; display:inline')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="allow_cash" class="col-sm-3 control-label">Enable cash payments</label>
                <div class="col-sm-9">
                    {!! Form::select('data[allow_cash]', config('settings.allow_cash'),($oSettings->where('key','allow_cash')->first())?$oSettings->where('key','allow_cash')->first()->value:'null',array('class'=>'form-control','id'=>'allow_cash', 'style' => 'width:180px; display:inline')) !!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="notifications">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i>Notifications to customers!</h4>
                Set and customize email notifications to your customers to prompt new actions or send them important information. You can enable or disable sending the notifications below. You can personalize emails with subscribers' names and other information using the available tokens.
            </div>
            <div class="form-group">
                <label for="email_confirmation" class="col-sm-3 control-label">New Reservation Received email &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="  Select 'Yes' if you want to send an email to clients after they make new reservation. Otherwise select 'No'. "></label>
                <div class="col-sm-9">
                    {!! Form::select('data[email_confirmation]', config('settings.email_confirmation'),($oSettings->where('key','email_confirmation')->first())?$oSettings->where('key','email_confirmation')->first()->value:'null',array('class'=>'form-control','id'=>'email_confirmation')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="email_confirmation_subject" class="col-sm-3 control-label">New Reservation email subject &nbsp;&nbsp;<img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="  A specific car is assigned to each new reservation. If reservation is not confirmed within X hours then this car will be available for booking again for the same date and time."></label>
                <div class="col-sm-9">
                    {!! Form::text('data[email_confirmation_subject]', ($oSettings->where('key','email_confirmation_subject')->first())?$oSettings->where('key','email_confirmation_subject')->first()->value:null, ['class' => 'form-control', 'id' => 'email_confirmation_subject', 'placeholder' => 'Email Subject']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="rental_terms" class="col-sm-3 control-label">New Reservation email message<br/>
                   <small>{Title}<br/>
                    {Name}<br/>
                    {Email}<br/>
                    {Phone}<br/>
                    {Country}<br/>
                    {City}<br/>
                    {State}<br/>
                    {Zip}<br/>
                    {Address}<br/>
                    {Company}<br/>
                    {Notes}<br/>
                    {DtFrom}{DtTo}<br/>
                    {PickupLocation}<br/>
                    {ReturnLocation}<br/>
                    {Type}<br/>
                    {Extras}<br/>
                    {BookingID}<br/>
                    {UniqueID}<br/>
                    {Deposit}<br/>
                    {Total}<br/>
                    {Tax}<br/>
                    {Security}<br/>
                    {Insurance}<br/>
                    {PaymentMethod}<br/>
                    {CCType}<br/>
                    {CCNum}<br/>
                    {CCExp}<br/>
                    {CCSec}<br/>
                    {CancelURL}</small> </label>
                <div class="col-sm-9">
                    {!! Form::textarea('data[email_confirmation_message]',($oSettings->where('key','email_confirmation_message')->first())?$oSettings->where('key','email_confirmation_message')->first()->value:null,['class'=>'form-control', 'rows' => '30', 'id' => 'email_confirmation_message']) !!}
                </div>
            </div>



            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>

    </div>
</div>
{!! Form::close() !!}