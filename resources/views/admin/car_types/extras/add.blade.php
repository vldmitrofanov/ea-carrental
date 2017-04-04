@extends('admin.partials.layouts.master')
@section('title')
    Car Type Extras Management | Add New
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Extras Management
            <small>Create New</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    @include('admin.partials.errors.errors')
                    <div class="alert alert-info alert-dismissible">
                        <h4><i class="icon fa fa-info"></i> Add an extra!</h4>
                        Fill in the form below to add an extra, then click Save. Tip: Enter 0 if you want to add a free extra.
                    </div>
                    {!! Form::open(array('url' => 'admin/extras/store', 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
                        @include('admin.car_types.extras.form', ['submit_button'=>'Create'])
                </div>

            </div>
        </div> 
    </section>
</div>
@endsection
