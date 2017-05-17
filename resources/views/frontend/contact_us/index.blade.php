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

	<div class="container formAndVerify inquiry text-center">
		<div class="row">
			<div class="col-sm-4">
				<img src="{{asset('template/images/ea-travel.jpg')}}" alt="" />
			</div>
			<div class="col-sm-8">
				<p>Our Car Rental service offers you a great choice of vehicles for hire in Malaysia. Whether you would like an economical sedan to get you going or a luxury car or van we have the option for you. We feature cars of different make</p>
				<h2>Contact Us For Any Car Rental Needs:</h2>
				<a class="btnGroup" href="{{ url('contact-us/contact')  }}">Submit Inquiry >></a>
			</div>
		</div>
		<div class="row tagLineDetail OurCars">

			<div class="col-sm-6 tagLine text-center">
				<h2>
					Our cars are a sheer pleasure to drive! Get your dream car rented today!
				</h2>
			</div>
			<div class="col-sm-6">
				<img class="img-responsive" src="{{asset('template/images/car.jpg')}}" alt="">
			</div>
		</div>
	</div>


@endsection
