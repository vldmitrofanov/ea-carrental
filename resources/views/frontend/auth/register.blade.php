@extends('frontend.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    User Registration | Embassy Alliance
@endsection

@section('content')
    @include('frontend.partials.errors.errors')


    <div class="signInContainer">
        <div class="signInForm text-center">
            <h2>Create New Account</h2>
            {!! Form::open(array('url' => 'register', 'method' => 'post', 'name'=>'registerForm', 'id'=>'registerForm')) !!}
                <div class="form-group completeForm">
                    <div class="driverDetails text-left">
                        <h3>Personal Details</h3>
                        <div class="topField">
                            {!! Form::select('title', config('settings.user_title'),null,array('id'=>'title')) !!}
                            <input placeholder="First Name" name="name" id="name" type="text">
                        </div>
                        <input placeholder="Sur Name" name="last_name" id="last_name" type="text">
                        <input placeholder="IC / Passport Number" name="passport_id" id="passport_id" type="text">
                        <input placeholder="Mobile Number with Country Code" name="phone" id="phone" type="text">
                        <input placeholder="Address" name="address" id="address" type="text">
                        <input placeholder="State" name="state" id="state" type="text">
                        <input placeholder="City" name="city" id="city" type="text">
                        <input placeholder="Zip Code" name="zip" id="zip" type="text">
                        {!! Form::select('country_id', array(''=>'Please Select')+$oCountries,null,array('style'=>'width:100%','id'=>'country_id')) !!}
                        <h3>Contact Details</h3>
                        <input placeholder="Email" name="email" id="email" type="text">
                        <input placeholder="User Name" name="username" id="username" type="text">
                        <input placeholder="Preferred Password to our System" name="password" id="password" type="password">
                        <input placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" type="password">

                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary text-uppercase">Sign Up</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('template/js/users.js') }}"></script>
@endsection