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
                    <div class="">
                        <span class="points">3</span>
                        <span class="title">Detials and Extras</span>
                    </div>
                </li>
                <li>
                    <div class="stepActive">
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
        <div class="row completeForm checkoutPage">
            {!! Form::open(array('url' => 'checkout', 'method' => 'post', 'name'=>'checkoutForm', 'id'=>'checkoutForm')) !!}
            <div class="col-sm-8 bottom text-center">
                <div class="driverDetails">
                    <h3>Billing Details</h3>
                    <div class="topField">
                        <input type="text" placeholder="First Name" name="bfirst_name" />
                    </div>
                    <input type="text" placeholder="Last Name" name="blast_name" />
                    {!! Form::select('bcountry_id', array('' => 'Select Country')+$oCountries,null,array('id'=>'bcountry_id')) !!}
                    <input type="text" placeholder="Address Line 1" name="baddress1" id="baddress1" />
                    <input type="text" placeholder="Address Line 2" name="baddress2" id="baddress2" />
                    <input type="text" placeholder="City" name="bcity" id="bcity" />
                    <input type="text" placeholder="State" name="bstate" id="bstate" />
                    <input type="text" placeholder="Zip/Postal code" name="bzip" id="bzip" />
                    <h3>Payment</h3>
                    {!! Form::select('cc_type', array(''=>'Please Select')+config('settings.cc_types'),null,array('class'=>'form-control','id'=>'cc_type')) !!}
                    <input type="text" placeholder="Card Number" name="cc_number" id="cc_number" />
                    <div class="cardExpire">
                        <input type="text" placeholder="Month" name="cc_expiration_month" id="cc_expiration_month" />
                        <span>/</span>
                        <input type="text" placeholder="Year" name="cc_expiration_year" id="cc_expiration_year" />
                        <i>Expiration</i>
                    </div>
                    <div class="cvv">
                        <input type="text" placeholder="" name="cc_code" id="cc_code" />
                        <img src="{{asset('template/images/bitmap.png')}}" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4 top">
                <div class="bookSummary">
                    <h3>Booking Summary</h3>
                    <?php //print_r($cartData);exit;?>
                    <ul>
                        <li>
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Rental Car</div>
                                <div class="col-xs-6 bookingColHeading text-right">Total {{$currency}}</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">{{ $cartData[key($cartData)]->info['car']->makeAndModel->make }} {{ $cartData[key($cartData)]->info['car']->makeAndModel->model}}</div>
                                <div class="col-xs-6 totalAmount text-right">{{ $cartData[key($cartData)]->info['prices']['total_price'] }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-6 col-sm-12">
                                    <img class="container img-responsive" src="{{Storage::url($cartData[key($cartData)]->info['car']->thumb_image)}}" alt="" />
                                </div>
                                <div class="col-xs-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-12 mt10">
                                            <div class="bookingColHeading col-sm-6 pad-0">From</div>
                                            <div class="bookingColHeading col-sm-6 pad-0">To</div>
                                        </div>
                                        <div class="col-xs-8 col-sm-12">
                                            <div class="col-sm-6 pad-0">
                                                <span>{{ \Carbon\Carbon::parse($cartData[key($cartData)]->date_from)->format('d F Y') }}</span>
                                                <span class="font-16 hideOnSmall">{{ \Carbon\Carbon::parse($cartData[key($cartData)]->date_from)->format('l H:i') }}</span>
                                            </div>
                                            <div class="col-sm-6 pad-0">
                                                <span>{{ \Carbon\Carbon::parse($cartData[key($cartData)]->date_to)->format('d F Y') }}</span>
                                                <span class="font-16 hideOnSmall">{{ \Carbon\Carbon::parse($cartData[key($cartData)]->date_to)->format('l H:i') }}</span>
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
                                    {{ $reservationDateTime['days'] }} Day Rental
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>{{$currencySymbol}} {{ $cartData[key($cartData)]->info['prices']['price_per_day'] }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    {{ $reservationDateTime['hours'] }} Hour Rental
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>{{$currencySymbol}} {{ $cartData[key($cartData)]->info['prices']['price_per_hour'] }}</span>
                                </div>
                            </div>
                        </li>
                        
                        @if($cartData[key($cartData)]->info['prices']['discount']>0)
                        <li class="bgGray showLess">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Discounts</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    {{ $cartData[key($cartData)]->info['prices']['discount_detail'] }}
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>{{$currencySymbol}} {{ $cartData[key($cartData)]->info['prices']['discount'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        
                        @if($cartData[key($cartData)]->info['prices']['car_rental_fee']>0)
                        <li class="bgGray showLess rentalfee">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Car Rental Fee</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 rentalfee-label"></div>
                                <div class="col-xs-6 weight-700">
                                    <span>{{$currencySymbol}} {{ $cartData[key($cartData)]->info['prices']['car_rental_fee'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        
                        @if($cartData[key($cartData)]->info['prices']['extra_price']>0)
                        <li class="bgGray showLess">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Additional Services</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    Extra Services
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>{{$currencySymbol}} {{ $cartData[key($cartData)]->info['prices']['extra_price'] }}</span>
                                </div>
                            </div>                            
                        </li>
                        @endif
                        
                        @if($cartData[key($cartData)]->info['prices']['insurance']>0)
                        <li class="bgGray showLess insurance">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Insurance</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">{{ $cartData[key($cartData)]->info['prices']['insurance_detail'] }}</div>
                                <div class="col-xs-6 weight-700">
                                    <span>{{$currencySymbol}} {{ $cartData[key($cartData)]->info['prices']['insurance'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        
                        <li class="bgGray showLess subtotal">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Sub-total</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 subtotal-label"></div>
                                <div class="col-xs-6 weight-700">
                                    <span>{{$currencySymbol}} {{ $cartData[key($cartData)]->info['prices']['sub_total'] }}</span>
                                </div>
                            </div>
                        </li>
                        
                        @if($cartData[key($cartData)]->info['prices']['tax']>0)
                        <li class="bgGray showLess">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Taxes</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    {{ $cartData[key($cartData)]->info['prices']['tax_detail'] }}
                                </div>
                                <div class="col-xs-6 weight-700">
                                    <span>{{$currencySymbol}} {{ $cartData[key($cartData)]->info['prices']['tax'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        
                        <li class="showLess">
                            <div class="row">
                                <div class="totalpayment col-xs-12">
                                    <div class="bgGray">
                                        <div class="bookingColHeading text-right">Total {{$currency}}</div>
                                        <div class="weight-700">{{ $cartData[key($cartData)]->info['prices']['total_price'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        @if($cartData[key($cartData)]->info['prices']['required_deposit']>0)
                        <li class="bgGray showLess hidden deposit">
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Required Deposit</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 deposit-label">{{ $cartData[key($cartData)]->info['prices']['required_deposit_detail'] }}</div> 
                                <div class="col-xs-6 weight-700">
                                    <span>{{$currencySymbol}} {{ $cartData[key($cartData)]->info['prices']['required_deposit'] }}</span>
                                </div>
                            </div>
                        </li>
                        @endif
                        
                        <li class="showLess">
                            <a role="button" class="btn btn-default btn-checkout" href="javascript:;">CHECKOUT</a>
                        </li>
                        <li  class="visible-xs moreDetail">
                            <span>More Details</span> <i class="fa fa-angle-down"></i>
                        </li>
                    </ul>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('template/js/checkout.js') }}"></script>
@endsection