@extends('frontend.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Embassy Alliance
@endsection

@section('content')
<div class="bannerCarSearch darkBg changeDate">
    <div>
        <div class="panel-body">
            <form class="form-inline">
                <div class="form-group">
                    <label>Welcome {{ Auth::user()->username }}!</label>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container adminPage">
    <div class="row">
        @include('frontend.partials.errors.errors')
        @include('frontend.dashboard.sidebar_menu')        
        
        <div class="col-sm-8">
            @foreach($oReservations as $oReservation)
            <div class="searchCarList">
                <div class="carStep1"></div>
                <h4>{{ $oReservation->processed_on }}</h4>
                <div class="row">
                    <div class="col-sm-2">
                        <a href="form.html"><img src="{{asset('template/images/smallCar.png')}}" alt=""></a> 
                    </div>
                    <div class="col-sm-5">
                        <h3>{{ $oReservation->details->first()->car->makeAndModel->make }} {{ $oReservation->details->first()->car->makeAndModel->model }}</h3>
                        <p class="redColor">{{$oReservation->details->first()->rental_days}} days and {{$oReservation->details->first()->rental_hours}} hours</p>
                    </div>
                    <div class="col-sm-5 text-right">
                        <div class="theInfo"> 
                            <span class="theBlue"><img src="{{asset('template/images/1.png')}}" alt="">2</span> 
                            <span class="theBlue"><img src="{{asset('template/images/2.png')}}" alt="">2</span> 
                            <span class="theBlue"><img src="{{asset('template/images/3.png')}}" alt="">2</span> 
                            <span class="theBlue"><img src="{{asset('template/images/4.png')}}" alt="">2</span>
                        </div>
                    </div>
                </div>
                <div class="row moreDetailAdmin">
                    <div class="moreDetail">
                        <span>More Details</span>
                        <i class="fa fa-angle-down"></i>
                    </div>
                    <div class="bookSummary showLess" style="display:block;">
                        <ul>
                            <li class="bgGray">
                                <div class="row">
                                    <div class="col-xs-6 bookingColHeading">Rental</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        {{$oReservation->details->first()->rental_days}} Days Rental
                                    </div>
                                    <div class="col-xs-6 weight-700">
                                        <span>{{$currency}} {{$oReservation->details->first()->price_per_day}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        {{$oReservation->details->first()->rental_hours}} Hours Rental
                                    </div>
                                    <div class="col-xs-6 weight-700">
                                        <span>{{$currency}} {{$oReservation->details->first()->price_per_hour}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="bgGray">
                                <div class="row">
                                    <div class="col-xs-6 bookingColHeading">Additional Services</div>
                                </div>
                                @foreach($oReservation->extras as $oExtra)
                                <div class="row">
                                    <div class="col-xs-6">
                                        {{$oExtra->quantity}} x {{$oExtra->extra->name}}
                                    </div>
                                    <div class="col-xs-6 weight-700">
                                        <span>{{$currency}} <?php echo $oExtra->quantity * $oExtra->price; ?></span>
                                    </div>
                                </div>
                                @endforeach
                            </li>
                            @if($oReservation->details->first()->discount>0)
                            <li class="bgGray">
                                <div class="row">
                                    <div class="col-xs-6 bookingColHeading">Discounts</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        6% 
                                    </div>
                                    <div class="col-xs-6 weight-700">
                                        <span>{{$currency}} {{$oReservation->details->first()->discount}}</span>
                                    </div>
                                </div>
                            </li>
                            @endif
                            <li class="bgGray">
                                <div class="row">
                                    <div class="col-xs-6 bookingColHeading">Tax</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        {{--6% GST--}}
                                    </div>
                                    <div class="col-xs-6 weight-700">
                                        <span>{{$currency}} {{$oReservation->details->first()->tax}}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="totalRow row">
                        <div class="col-xs-4">
                            <img src="{{asset('template/images/visaEdit.png')}}" alt="" />
                        </div>
                        <div class="col-xs-4 text-right bookingColHeading">Total {{$currency}}</div>
                        <div class="col-xs-4 text-right">{{$oReservation->details()->sum('total_price')}}</div>
                        <div class="col-xs-12 text-right btnGroupAdmin">
                            {{--<a href="#" class="btn btn-danger greenButton" role="button">Edit Order</a>--}}
                            {{--<a href="#" class="btn btn-danger" role="button">Cancel Order <i class="fa fa-times"></i></a>--}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection