@extends('frontend.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Embassy Alliance
@endsection

@section('content')
    @include('frontend.searchbar.search_inner')
    <div class="container formAndVerify">
        <form method="post" name="car_reservation" id="car_reservation">
        <input type="hidden" name="rental_days" id="rental_days">
        <input type="hidden" name="rental_hours" id="rental_hours">
        <input type="hidden" name="price_per_day" id="price_per_day">
        <input type="hidden" name="price_per_day_detail" id="price_per_day_detail">
        <input type="hidden" name="price_per_hour" id="price_per_hour">
        <input type="hidden" name="price_per_hour_detail" id="price_per_hour_detail">
        <input type="hidden" name="car_rental_fee" id="car_rental_fee">
        <input type="hidden" name="extra_price" id="extra_price">
        <input type="hidden" name="insurance" id="insurance">
        <input type="hidden" name="sub_total" id="sub_total">
        <input type="hidden" name="tax" id="tax">
        <input type="hidden" name="total_price" id="total_price">
        <input type="hidden" name="required_deposit" id="required_deposit">
        <input type="hidden" name="passport" id="passport" value="">
        <input type="hidden" name="licence" id="licence" value="">
        <input type="hidden" name="rental_form" id="rental_form" value="">
        <input type="hidden" name="discount" id="discount" value="">
        <input type="hidden" name="discount_detail" id="discount_detail" value="">
        <input type="hidden" name="rdate_start" id="rdate_start" value="">
        <input type="hidden" name="rdate_end" id="rdate_end" value="">
        <input type="hidden" name="date_from" id="date_from" value="">
        <input type="hidden" name="date_to" id="date_to" value="">


            <div class="stepsContainer">
                <div class="stepRow"></div>
                <ul class="carSteps">
                    <li>
                        <div>
                            <span class="points">1</span>
                            <span class="title">Select Dates</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="points">2</span>
                            <span class="title">Select Car</span>
                        </div>
                    </li>
                    <li>
                        <div class="stepActive">
                            <span class="points">3</span>
                            <span class="title">Detials and Extras</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="points">4</span>
                            <span class="title">Checkout</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img src="{{asset('template/images/greencar.png')}}" alt="" />
                        </div>
                    </li>
                </ul>
            </div>
            <div class="row completeForm">
            <div class="col-sm-4 bottom">
                <div class="driverDetails">
                    <h3>Driver Details</h3>
                    <div class="topField">
                        {!! Form::select('title', config('settings.user_title'),null,array('id'=>'title')) !!}
                        <input type="text" placeholder="" />
                    </div>
                    <input type="text" name="sur_name" placeholder="Sur Name" />
                    <input type="text" name="passport_no" id="passport_no" placeholder="IC / Passport Number" />
                    <h3>Contact Details</h3>
                    <input type="text" name="email" id="email" placeholder="Email" />
                    <input type="text" name="mobile_no" id="mobile_no" placeholder="Mobile Number with Country Code" />
                    <input type="text" id="password" name="password" placeholder="Preferred Password to our System" />
                    <h3>Driver Details</h3>
                    <input type="text" name="pick_up" id="pick_up" placeholder="Pick Up" />
                    <input type="text" name="return" id="return" placeholder="Return" />
                    <h3>Discount Coupon</h3>
                    <input type="text" name="coupon_code" id="coupon_code" placeholder="Coupon Number" />
                    <img class="img-responsive" src="{{asset('template/images/googeMap.png')}}" />
                </div>
            </div>
            <div class="col-sm-4 middle">
                <div class="bookExtras">
                    <h3>Extras</h3>
                    <ul>
                        @foreach($oCar->makeAndModel->extras as $oExtra)
                        <li>
                            <div class="col-xs-6">
                                <span>{{$oExtra->name}}</span>
                                <span class="amountColor">{{$currencySymbol}}{{$oExtra->price}}/{{$oExtra->per}}</span>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" data-toggle="tooltip" title="tooltip text here">
                                    <img src="{{asset('template/images/infoIcon.png')}}" alt="" />
                                </a>
                                <div class="divider hidden-sm"></div>
                                <label class="switch2">
                                    <input name="extras[]" value="{{$oExtra->id}}" type="checkbox">
                                    <div class="slider2 round"></div>
                                </label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 top">
                <div class="bookSummary">
                    <h3>Booking Summary</h3>
                    <ul>
                        <li>
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Selected Car <a href="search-inner.html"><img src="{{asset('template/images/edit-icon.png')}}" /></a></div>
                                <div class="col-xs-6 bookingColHeading text-right">Total {{$currency}}</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">{{$oCar->makeAndModel->make}} {{$oCar->makeAndModel->model}}</div>
                                <div class="col-xs-6 totalAmount text-right total-csot"></div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-6 col-sm-12">
                                    <img class="container img-responsive" src="{{asset($oCar->thumb_image)}}" alt="" />
                                </div>
                                <div class="col-xs-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-12 mt10">
                                            <div class="bookingColHeading col-sm-6 pad-0">From
                                                <div class='input-group date' id='resetDateStart'>
                                                    <input type='text' class="form-control" />
                                                    <span class="input-group-addon">
														<img class="hidden-xs" src="{{asset('template/images/edit-icon.png')}}" />
													</span>
                                                </div>
                                            </div>
                                            <div class="bookingColHeading col-sm-6 pad-0">To
                                                <div class='input-group date' id='resetDateEnd'>
                                                    <input type='text' class="form-control" />
                                                    <span class="input-group-addon">
														<img class="hidden-xs" src="{{asset('template/images/edit-icon.png')}}" />
													</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-8 col-sm-12">
                                            <div class="col-sm-6 pad-0">
                                                <span class="start_date"></span>
                                                <span class="font-16 hideOnSmall start_time"></span>
                                            </div>
                                            <div class="col-sm-6 pad-0">
                                                <span class="end_date"></span>
                                                <span class="font-16 hideOnSmall end_time"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="bgGray showLess">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Rental</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    3 Day Rental
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>USD 120.00</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    03 March 2017
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>USD 12.00</span>
                                </div>
                            </div>
                        </li>
                        <li class="bgGray showLess">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Additional Services</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    1 X Additional Driver
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>USD 10.00</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    3D X Baby Seat
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>USD 30.00</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    3D X Navigation System
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>USD 15.00</span>
                                </div>
                            </div>
                        </li>
                        <li class="bgGray showLess">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Discounts</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    6%
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>USD 2</span>
                                </div>
                            </div>
                        </li>
                        <li class="bgGray showLess">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Taxes</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    6% GST
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>USD 11.22</span>
                                </div>
                            </div>
                        </li>
                        <li class="showLess">
                            <div class="row">
                                <div class="totalpayment col-xs-12">
                                    <div class="bgGray">
                                        <div class="bookingColHeading text-right">Total {{$currency}}</div>
                                        <div class="weight-700 total-cost"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="showLess">
                            <a role="button" class="btn btn-default" href="">CONTINUE</a>
                        </li>
                        <li  class="visible-xs moreDetail">
                            <span>More Details</span> <i class="fa fa-angle-down"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function(){

            $('#resetDateStart').datetimepicker().on('dp.change',function(event){
                $('#rdate_start').val(event.date);
                calculatePrices();
            });
            $('#resetDateEnd').datetimepicker().on('dp.change',function(event){
                $('#rdate_end').val(event.date);
                calculatePrices();
            });
        });
        function calculatePrices(){
            processing();
            var formData = $('form#car_reservation').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            $.post('/fleet/calculate_difference', formData)
            .done(function(response){
                $('#rental_days').val(response.days);
                $('#rental_hours').val(response.hours);

                $('span.start_date').html(response.start_date);
                $('span.start_time').html(response.start_time);
                $('span.end_date').html(response.end_date);
                $('span.end_time').html(response.end_time);

                $("table.payment_detail> tbody tr:first").find('td').html(
                    response.days+" Days and "+ response.hours+" Hours"
                );
                $.unblockUI();
            })
            .fail(function(response){
                $.unblockUI();
                $.each(response.responseJSON, function (key, value) {
                    $.each(value, function (index, message) {
                        displayMessageAlert(message, 'danger', 'warning-sign');
                    });
                });
            });
        }

        function calculateRental () {
            processing();
            var formData = $('form#car_reservation').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            $.post('/admin/reservations/load_car_prices', formData)
                .done(function(response){
                    var prices = response.data.prices;
                    var currency = response.data.currency;
                    var currencySign = response.data.currencySign;

                    $('#price_per_day').val(prices.price_per_day);
                    $('#price_per_day_detail').val(prices.price_per_day_detail);
                    $('#price_per_hour').val(prices.price_per_hour);
                    $('#price_per_hour_detail').val(prices.price_per_hour_detail);
                    $('#car_rental_fee').val(prices.car_rental_fee);
                    $('#extra_price').val(prices.extra_price);
                    $('#insurance').val(prices.insurance);
                    $('#sub_total').val(prices.sub_total);
                    $('#tax').val(prices.tax);
                    $('#total_price').val(prices.total_price);
                    $('#required_deposit').val(prices.required_deposit);
                    $('#discount').val(prices.discount);
                    $('#discount_detail').val(prices.discount_detail);

                    $("table.payment_detail> tbody tr:nth-child(2)").find('th').html('Price per day:<br/><small>'+prices.price_per_day_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(2)").find('td').html(currencySign+' '+prices.price_per_day);

                    $("table.payment_detail> tbody tr:nth-child(3)").find('th').html('Discount:<br/><small>'+prices.discount_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(3)").find('td').html(currencySign+' '+prices.discount);


                    $("table.payment_detail> tbody tr:nth-child(4)").find('th').html('Price per hour:<br/><small>'+prices.price_per_hour_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(4)").find('td').html(currencySign+' '+prices.price_per_hour);


                    $("table.payment_detail> tbody tr:nth-child(5)").find('th').html('Car rental fee:<br/><small>'+prices.car_rental_fee_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(5)").find('td').html(currencySign+' '+prices.car_rental_fee);


                    $("table.payment_detail> tbody tr:nth-child(6)").find('td').html(currencySign+' '+prices.extra_price);

                    $("table.payment_detail> tbody tr:nth-child(7)").find('th').html('Insurance:<br/><small>'+prices.insurance_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(7)").find('td').html(currencySign+' '+prices.insurance);

                    $("table.payment_detail> tbody tr:nth-child(8)").find('td').html(currencySign+' '+prices.sub_total);

                    $("table.payment_detail> tbody tr:nth-child(9)").find('th').html('Tax:<br/><small>'+prices.tax_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(9)").find('td').html(currencySign+' '+prices.tax);

                    $("table.payment_detail> tbody tr:nth-child(10)").find('td').html(currencySign+' '+prices.total_price);
                    $("table.payment_detail> tbody tr:nth-child(11)").find('td').html(currencySign+' '+prices.required_deposit);

                    $.unblockUI();
                })
                .fail(function(response){
                    $.unblockUI();
                    $.each(response.responseJSON, function (key, value) {
                        $.each(value, function (index, message) {
                            displayMessageAlert(message, 'danger', 'warning-sign');
                        });
                    });

//                    $('input#date_from').val('');
//                    $('input#date_to').val('');
                });
        }

    </script>
@endsection