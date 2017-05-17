@extends('frontend.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Embassy Alliance
@endsection

@section('content')
    @include('frontend.searchbar.searchbar')
    @include('frontend.partials.errors.errors')
    {!! Form::open(array('url' => 'contact-us/contact', 'method' => 'post', 'class'=>'form-inline', 'name'=>'contact', 'id'=>'contact')) !!}

<div class="container formAndVerify OurCars">
    <h4>Our best car rental discounts and offers in Malaysia and singapore</h4>
    <div class="row rentalPackages text-center text-uppercase">
        <div class="col-md-4">
            <div class="theBox">
                <div class="theDiscount">-10%</div>
                <div class="theText">WHEN BOOKING <span class="text-danger">7 DAYS</span></div>
                <div class="thePluse"><i class="fa fa-plus"></i></div>
                <div class="theText">FREE EXCLUSIVE <span class="text-danger">PEN</span></div> <a href="javascript:;" role="button" class="btn btn-danger">Book Now</a> </div>
        </div>
        <div class="col-md-4">
            <div class="theBox">
                <div class="theDiscount">-25%</div>
                <div class="theText">WHEN BOOKING <span class="text-danger">14 DAYS</span></div>
                <div class="thePluse"><i class="fa fa-plus"></i></div>
                <div class="theText">FREE EXCLUSIVE <span class="text-danger">PEN</span></div> <a href="javascript:;" role="button" class="btn btn-danger">Book Now</a> </div>
        </div>
        <div class="col-md-4">
            <div class="theBox">
                <div class="theDiscount">-40%</div>
                <div class="theText">WHEN BOOKING <span class="text-danger">14 DAYS</span></div>
                <div class="thePluse"><i class="fa fa-plus"></i></div>
                <div class="theText">FREE EXCLUSIVE <span class="text-danger">PEN</span></div> <a href="javascript:;" role="button" class="btn btn-danger">Book Now</a> </div>
        </div>
    </div>
    <div class="row completeForm">
        <h3 class="text-center">Contact Us For Any Car Rental Needs:</h3>
        <div class="col-sm-6 text-center">
            <h2>
                Our cars are a sheer pleasure to drive! Get your dream car rented today!
            </h2>
            <img class="img-responsive" src="{{asset('template/images/car.jpg')}}" alt="">
            <a class="btnGroup" href="{{ url('our_fleet') }}">Book and confirm instantly >></a>
        </div>
        <div class="col-sm-6">
            <div class="driverDetails">
                <input type="text" name="name" id="name" placeholder="Name" />
                <input type="text" name="contact_number" id="contact_number" placeholder="Contact Number" />
                <input type="text" name="email" id="email" placeholder="Email" />
                <textarea class="form-control" name="message" id="message" rows="10" placeholder="Message"></textarea>
                {!!  Recaptcha::render([ 'lang' => 'en' ]) !!}
                <div class="text-center">
                    <button type="submit" class="btnGroup">Submit Inquiry >></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row  text-center">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
    </div>
</div>
    {!! Form::close() !!}
@endsection


<?php /*
 * https://tuts.codingo.me/google-recaptcha-in-laravel-application
 */ ?>