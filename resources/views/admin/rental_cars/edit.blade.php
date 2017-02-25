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
                            <h4><i class="icon fa fa-info"></i> Update car!</h4>
                            Update your vehicle data. If you have multi language front-end do not forget to update vehicle make and model in all languages.
                        </div>
                        {!! Form::model($oRentalCar, array('url' =>array('admin/cars/update', $oRentalCar->id), 'id' => 'rental_car', 'method' => 'PATCH', 'enctype'=>'multipart/form-data')) !!}
                        @include('admin.rental_cars.form', ['submit_button'=>'Create'])
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection