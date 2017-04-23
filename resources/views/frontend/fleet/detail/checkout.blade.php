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
                        <img src="images/greencar.png" alt="" />
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
                        <input type="text" placeholder="" />
                    </div>
                    <input type="text" placeholder="Last Name*" />
                    <select>
                        <option>Country </option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                    <input type="text" placeholder="Address Line 1*" />
                    <input type="text" placeholder="Address Line 2*" />
                    <input type="text" placeholder="City*" />
                    <input type="text" placeholder="State" />
                    <input type="text" placeholder="Zip/Postal code*" />
                    <h3>Payment</h3>
                    <select>
                        <option>Card </option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                    <input type="text" placeholder="Card Number" />
                    <div class="cardExpire">
                        <input type="text" placeholder="" />
                        <span>/</span>
                        <input type="text" placeholder="" />
                        <i>Expiration</i>
                    </div>
                    <div class="cvv">
                        <input type="text" placeholder="" />
                        <img src="images/bitmap.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4 top">
                <div class="bookSummary">
                    <h3>Booking Summary</h3>
                    <ul>
                        <li>
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">Selected Car <img src="images/edit-icon.png" /></div>
                                <div class="col-xs-6 bookingColHeading text-right">Total USD</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">Mitsubishi Attrage</div>
                                <div class="col-xs-6 totalAmount text-right">198.22</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-6 col-sm-12">
                                    <img class="container img-responsive" src="images/car2.jpg" alt="" />
                                </div>
                                <div class="col-xs-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-12 mt10">
                                            <div class="bookingColHeading col-sm-6 pad-0">From <img class="hidden-xs" src="images/edit-icon.png" /></div>
                                            <div class="bookingColHeading col-sm-6 pad-0">To <img class="hidden-xs" src="images/edit-icon.png" /></div>
                                        </div>
                                        <div class="col-xs-8 col-sm-12">
                                            <div class="col-sm-6 pad-0">
                                                <span>03 March 2017</span>
                                                <span class="font-16 hideOnSmall">Thursday 10:00</span>
                                            </div>
                                            <div class="col-sm-6 pad-0">
                                                <span>06 March 2017</span>
                                                <span class="font-16 hideOnSmall">Sunday 12:00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!--li class="text-center">
                            <img class="container img-responsive" src="images/car2.jpg" alt="" />
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xs-6 bookingColHeading">From <img src="images/edit-icon.png" /></div>
                                <div class="col-xs-6 bookingColHeading">To <img src="images/edit-icon.png" /></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <span>03 March 2017</span>
                                    <span class="font-16">Thursday 10:00</span>
                                </div>
                                <div class="col-xs-6">
                                    <span>06 March 2017</span>
                                    <span class="font-16">Sunday 12:00</span>
                                </div>
                            </div>
                        </li -->
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
                                        <div class="bookingColHeading text-right">Total USD</div>
                                        <div class="weight-700">198.22</div>
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
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{ asset('template/js/reservation.js') }}"></script>
@endsection