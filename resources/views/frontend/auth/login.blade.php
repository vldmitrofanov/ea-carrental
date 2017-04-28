@extends('frontend.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    User Login | Embassy Alliance
@endsection

@section('content')
    @include('frontend.partials.errors.errors')

    <div class="signInContainer">
        <div class="signInForm text-center">
            <h2>Sign In</h2>
            {!! Form::open(array('url' => 'login', 'method' => 'post', 'name'=>'loginForm', 'id'=>'loginForm')) !!}
                <div class="form-group">
                    <input class="form-control" id="username" name="username" placeholder="User Name" value="" type="text" />
                    <input class="form-control" id="password" name="password" placeholder="Password" type="password" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary text-uppercase btn-login">Sign In</button>
                    <div>
                        <a class="laba_log" href="{{url('register')}}">Register New Account</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection