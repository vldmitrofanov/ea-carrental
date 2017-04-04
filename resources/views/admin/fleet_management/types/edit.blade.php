@extends('admin.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Car Types Management | Update Info
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Types
                <small>Update Info</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        @include('admin.partials.errors.errors')
                        {!! Form::model($oFleetType, array('url' =>array('admin/fleet/types/update', $oFleetType->id), 'id' => 'car_type', 'method' => 'PATCH', 'enctype'=>'multipart/form-data')) !!}
                        {{ Form::hidden('type',$oFleetType->id ) }}
                        @include('admin.fleet_management.types.forms.edit', ['submit_button'=>'Update'])
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection