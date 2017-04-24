@extends('frontend.partials.layouts.master')

@section('title')
    Embassy Alliance
@endsection

@section('content')
    @include('frontend.home.carousel')
    @include('frontend.searchbar.search')

    @include('frontend.partials.errors.errors')
    <div class="container">
        <p class="lead text-center mb0">Our Car Rental service offers you a great choice of vehicles for hire in Malaysia. Whether you would like an economical sedan to get you going or a luxury car or van we have the option for you. We feature cars of different make: from Proton to Toyota and Kia, comfortable HyndaiStarex Vans, and luxurious BMW and Mercedes Vans.</p>
    </div>


    @include('frontend.home.rental_fleets')
    @include('frontend.home.services')
    @include('frontend.home.packages')


    <div class="mapContainer container-fluid">
        <div class="row">
            <div class="col-md-6"><img src="{{asset('template/images/img_5.jpg')}}" alt=""></div>
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16300242.76441895!2d100.56188595030339!3d4.111243049311603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3034d3975f6730af%3A0x745969328211cd8!2sMalaysia!5e0!3m2!1sen!2sin!4v1485181224055"></iframe>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.home.testimonials')

@endsection