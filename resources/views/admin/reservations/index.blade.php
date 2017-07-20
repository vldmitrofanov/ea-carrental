@extends('admin.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Car Reservations Management
@endsection

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}">
@endsection

@section('content')


    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Reservations
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/reservations/create')}}"><i class="fa fa-plus"></i> Add Reservation</a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Showing {!! $oReservations->currentPage() !!} of {!! $oReservations->lastPage() !!} </h3>

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

<div class="modal fade" id="editReservation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Reservation Info</h4>
            </div>
            <div class="modal-body"> 
                {!! Form::open(array('url' => 'admin/reservations/update_status', 'id' => 'editReservation', 'method' => 'post', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal')) !!}
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                    <div class="col-md-8 reservation-fields">
                        <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control">
                                    <option value="">-- Choose --</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="pending">Pending</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="collected">Collected</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        
                        
                    </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-editreservation">Save changes</button>
            </div>
        </div>
    </div>
</div>
        
@endsection

@section('javascript')
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script src="{{ asset('administration/dist/js/reservations.js') }}"></script>
@endsection