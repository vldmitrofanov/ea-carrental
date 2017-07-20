@extends('admin.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Car Collection Summary
@endsection

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Car Collection<small>Summary</small></h1>
        </section>
        
        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Filter From Date">
                                        </div>
                                        <div class="col-xs-5">
                                             <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Filter Till Date">
                                        </div>
                                        <div class="col-xs-2">
                                           <button type="button" class="btn btn-default btn-filter"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body ">
                            <table id="reservationsTbl" cellspacing="0" width="100%" class="display table table-hover">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Client Name</th>
                                    <th>Car</th>
                                    <th>Registration No</th>
                                    <th>Car Type</th>
                                    <th>Booking</th> 
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('administration/dist/js/reports/collection.js') }}"></script>
@endsection