@extends('admin.partials.layouts.master')
@section('title')
    Office Locations Management | Add New
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Office Locations
                <small>Create New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        @include('admin.partials.errors.errors')
                        {!! Form::open(array('url' => 'admin/locations/store', 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
                        @include('admin.office_locations.forms.add', ['submit_button'=>'Create'])
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection