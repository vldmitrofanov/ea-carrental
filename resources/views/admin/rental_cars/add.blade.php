@extends('admin.partials.layouts.master')
@section('title')
    Rental Cars Management | Add New
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Rental Cars
                <small>Create New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        @include('admin.partials.errors.errors')
                        <div class="alert alert-info alert-dismissible">
                            <h4><i class="icon fa fa-info"></i> Add new car!</h4>
                            Fill in the form below to add a new car. Please note that your clients are able to book a car type not a specific car/vehicle, so each car you add must be assigned to at least one car type. To add your cars/vehicles you need to have car types and locations added first.
                        </div>
                        {!! Form::open(array('url' => 'admin/cars/store', 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
                        @include('admin.rental_cars.form', ['submit_button'=>'Create'])
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection