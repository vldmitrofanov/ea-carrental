@extends('admin.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Settings Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Settings
                <small>Management</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                        @include('admin.partials.errors.errors')
                    {!! Form::open(array('url' => 'admin/settings/store', 'id' => 'settings', 'method' => 'post', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal')) !!}
                        @include('admin.settings.add', ['submit_button'=>'Create'])
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@endsection