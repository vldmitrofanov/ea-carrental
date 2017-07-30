@extends('frontend.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Embassy Alliance
@endsection

@section('content')
    @include('frontend.searchbar.search_inner')
    @include('frontend.partials.errors.errors')

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
        <input type="hidden" name="ref" id="ref" value="{{app('request')->get('ref')}}">
        <input type="hidden" name="car_id" id="car_id" value="{{$oCar->id}}">
        <input type="hidden" name="models" id="models" value="{{$oCar->makeAndModel->id}}">
        <input type="hidden" name="car_type_id" id="car_type_id" value="{{$oCar->makeAndModel->type_id}}">

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
                    <h3>Personal Details</h3>
                    @if (Auth::check())
                        <div class="topField">
                            {!! Form::select('title', config('settings.user_title'),Auth::user()->title,array('id'=>'title')) !!}
                            <input type="text" readonly placeholder="First Name" name="name" id="name" value="{{Auth::user()->getFirstName()}}" />
                        </div>
                        <input type="text" readonly name="sur_name" value="{{Auth::user()->getSurName()}}" placeholder="Sur Name" />
                        <input type="text" {{  (Auth::user()->passport_id!='')?'readonly':''}} name="passport_no" id="passport_no" placeholder="IC / Passport Number" value="{{Auth::user()->passport_id}}" />
                        <h3>Contact Details</h3>
                        <input type="text" readonly name="email" id="email" placeholder="Email"  value="{{Auth::user()->email}}"/>
                        <input type="text" {{  (Auth::user()->mobile_no!='')?'readonly':''}} name="mobile_no" id="mobile_no" placeholder="Mobile Number with Country Code"  value="{{Auth::user()->phone}}"/>
                    @else
                        <div class="topField">
                            {!! Form::select('title', config('settings.user_title'),null,array('id'=>'title')) !!}
                            <input type="text" placeholder="First Name" name="name" id="name" value= "">
                        </div>
                        <input type="text" name="sur_name" value="" placeholder="Sur Name" />
                        <input type="text" name="passport_no" id="passport_no" placeholder="IC / Passport Number" value="" />
                        <h3>Contact Details</h3>
                        <input type="text" name="mobile_no" id="mobile_no" placeholder="Mobile Number with Country Code" />
                        <input type="text" name="email" id="email" placeholder="Email" />
                        <input type="password" id="password" name="password" placeholder="Preferred Password to our System" />
                    @endif
                    <h3>Driver Details</h3>
                    <select name="pick_up" id="pick_up" style="width: 100%">
                        <option value="">Select Pick Up Location</option>
                        @foreach ($officeLocations as $officeLocation)
                            <option value="{{$officeLocation->id}}">{{$officeLocation->name}} {{$officeLocation->country->name}}</option>
                        @endforeach
                    </select>

                    <select name="return" id="return" style="width: 100%; margin-top: 20px;margin-bottom: 20px;">
                        <option value="">Select Return Location</option>
                        @foreach ($officeLocations as $officeLocation)
                            <option value="{{$officeLocation->id}}">{{$officeLocation->name}} {{$officeLocation->country->name}}</option>
                        @endforeach
                    </select>
                    <h3>Discount Coupon</h3>
                    <input type="text" name="discount_code" id="discount_code" placeholder="Coupon Number" style="width:50%;" />
                    <a role="button" class="btn btn-success validate-code" href="javascript:;" style="border-radius: 8px;margin-left: 4px;">Validate</a>
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
                                <a href="#" data-toggle="tooltip" title="{{$oExtra->name}}">
                                    <img src="{{asset('template/images/infoIcon.png')}}" alt="" />
                                </a>
                                <div class="divider hidden-sm"></div>
                                <label class="switch2">
                                    <input name="extra_id[]" data-currency="{{$currency}}" data-per="{{$oExtra->per}}" data-price="{{$oExtra->price}}" value="{{$oExtra->id}}" type="checkbox">
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
                                <div class="col-xs-6 bookingColHeading">Selected Car <a href="{{ url('our_fleet')  }}"><img src="{{asset('template/images/edit-icon.png')}}" /></a></div>
                                <div class="col-xs-6 bookingColHeading text-right">Total {{$currency}}</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">{{$oCar->makeAndModel->make}} {{$oCar->makeAndModel->model}}</div>
                                <div class="col-xs-6 totalAmount text-right total-cost"></div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-6 col-sm-12">
                                    @if($oCar && Storage::has($oCar->thumb_image))
                                        <img class="container img-responsive"  src="{{Storage::url($oCar->thumb_image)}}" alt="{{$oCar->makeAndModel->make}} {{$oCar->makeAndModel->model}}">
                                    @endif
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
                                <div class="col-xs-6 days-duration">
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span class="days-duration-price"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 hours-duration">
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span class="hours-duration-price"></span>
                                </div>
                            </div>
                        </li>
                        <li class="bgGray showLess discounts">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Discounts</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 discount-label"></div>
                                <div class="col-xs-6 weight-700">
                                    <span class="discount-amount"></span>
                                </div>
                            </div>
                        </li>
                        <li class="bgGray showLess rentalfee">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Car Rental Fee</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 rentalfee-label"></div>
                                <div class="col-xs-6 weight-700">
                                    <span class="rentalfee-amount"></span>
                                </div>
                            </div>
                        </li>
                        
                        <li class="bgGray showLess">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Additional Services</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 extra-label">
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span class="extra-amount"></span>
                                </div>
                            </div>
                        </li>
                        
                        <li class="bgGray showLess insurance">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Insurance</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 insurance-label"></div>
                                <div class="col-xs-6 weight-700">
                                    <span class="insurance-amount"></span>
                                </div>
                            </div>
                        </li>
                        
                        <li class="bgGray showLess subtotal">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Sub-total</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 subtotal-label"></div>
                                <div class="col-xs-6 weight-700">
                                    <span class="subtotal-fee"></span>
                                </div>
                            </div>
                        </li>

                        <li class="bgGray showLess">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Taxes</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 tax-label"></div>
                                <div class="col-xs-6 weight-700">
                                    <span class="tax-amount"></span>
                                </div>
                            </div>
                        </li>

                        <li class="bgGray showLess freeBiesInfo">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">FreeBies</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 freebies-label"></div>
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
                        
                        <li class="bgGray showLess hidden deposit">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Required Deposit</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 deposit-label"></div> 
                                <div class="col-xs-6 weight-700">
                                    <span class="deposit-fee"></span>
                                </div>
                            </div>
                        </li>
                        
                        <li class="showLess">
                            <a role="button" class="btn btn-default btn-continue" href="javascript:;">CONTINUE</a>
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
<script src="{{ asset('template/js/reservation.js') }}"></script>
<script>    
    $(document).ready(function(){
        @if($searchData)
        $('#rdate_start').val('{{$searchData->start}}');
        $('#rdate_end').val('{{$searchData->end}}');
        calculatePrices();
        @endif
    });
</script>    
@endsection