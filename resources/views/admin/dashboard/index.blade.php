
@extends('admin.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
Dashboard
@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('administration/plugins/morris/morris.css') }}">
<link rel="stylesheet" href="{{ asset('administration/plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" href="{{ asset('administration/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('administration/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.print.css">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $oReservations->where('status','pending')->count()  }}</h3>
                        <p>Pending Reservations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-model-s"></i>
                    </div>
                    <a href="{{url('admin/reservations')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php /*<div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> */ ?>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $oUsers->count()  }}</h3>
                        <p>Users Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href="{{url('admin/users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $oCustomers->count()  }}</h3>
                        <p>Clients Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{url('admin/clients')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Reservations</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Car</th>
                                    <th>Customer</th>
                                    <th>Duration</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oReservations->sortBy('id',1) as $oReservation)
                                    <tr>
                                        <td><a href="{{url('admin/reservations/'.$oReservation->id.'/edit')}}">{{$oReservation->reservation_number}}</a></td>
                                        <td>{{ $oReservation->details->first()->car->registration_number  }} ({{ $oReservation->details->first()->model->make  }} - {{ $oReservation->details->first()->model->model  }})</td>
                                        <td>{{ $oReservation->details->first()->car->registration_number  }} ({{ $oReservation->details->first()->model->make  }} - {{ $oReservation->details->first()->model->model  }})</td>
                                        <td>{!! Booking::calculateDateDiff($oReservation->details->first()->date_from, $oReservation->details->first()->date_to) !!}</td>
                                        <td>{!! Booking::formatTotal($oReservation->details->first()->total_price) !!}</td>
                                        <td><span class="label label-{{config('settings.order_colors')[$oReservation->status]}}">{{ $oReservation->status }}</span></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer clearfix">
                        <a href="{{url('admin/reservations/create')}}" class="btn btn-sm btn-info btn-flat pull-left">Place New Reservation</a>
                        <a href="{{url('admin/reservations')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Reservations</a>
                    </div>
                </div>


                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-envelope"></i>
                        <h3 class="box-title">Quick Email</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open(array('url' => 'admin/dashboard/email', 'id' => 'quickemail', 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
                            <div class="form-group">
                                <input type="email" class="form-control" name="emailto" id="emailto" placeholder="Email to:">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                            </div>
                            <div>
                                <textarea name="message" id="message" class="textarea" placeholder="Message" style="width: 100%; height: 225px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="box-footer clearfix">
                        <button type="button" class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                </div>

            </section>

        </div>

    </section>
</div>

@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('administration/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('administration/plugins/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('administration/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('administration/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <script src="{{ asset('administration/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('administration/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('administration/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('administration/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('administration/dist/js/demo.js') }}"></script>
    <script src="{{ asset('administration/dist/js/dashboad.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
@endsection