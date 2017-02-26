@extends('admin.partials.layouts.master')
@section('title')
    Car Reservations Management
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
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Client Name</th>
                                    <th>Car</th>
                                    <th>Car Type</th>
                                    <th>Pick-up/Return</th>
                                    <th>Total</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oReservations as $index =>$oReservation)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oReservation->user->name }} ({{ $oReservation->user->phone }})</td>
                                        <td>{{ $oReservation->date_to }}</td>
                                        <td>{{ $oReservation->created_at }}</td>
                                        <td>{{ $oReservation->status }}</td>
                                        <td>0</td>
                                        <td>
                                            <a href="{{ url('admin/reservations/'.$oReservation->id.'/edit') }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="{{ url('admin/reservations/'.$oReservation->id.'/delete') }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @if($oReservations->render())
                            <div class="box-footer clearfix">
                                {!! $oReservations->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

