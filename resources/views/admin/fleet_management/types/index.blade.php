@extends('admin.partials.layouts.master')
@section('title')
    Types Management | Fleet Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Types
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/fleet/types/create')}}"><i class="fa fa-plus"></i> Add Type</a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Showing {!! $oFleetTypes->currentPage() !!} of {!! $oFleetTypes->lastPage() !!} </h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Size of vehicle</th>
                                    <th>Number of doors</th>
                                    <th>Transmission & drive</th>
                                    <th>Fuel & A/C</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oFleetTypes as $index =>$oFleetType)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ ($oFleetType->vehicleSize)?$oFleetType->vehicleSize->description:'NA' }}</td>
                                        <td>{{ ($oFleetType->vehicleDoors)?$oFleetType->vehicleDoors->description:'NA' }}</td>
                                        <td>{{ ($oFleetType->vehicleTransmissionAndDrive)?$oFleetType->vehicleTransmissionAndDrive->description:'NA' }}</td>
                                        <td>{{ ($oFleetType->vehicleFuelAndAC)?$oFleetType->vehicleFuelAndAC->description:'NA' }}</td>
                                        <td><a href="{{ url('admin/fleet/types/'.$oFleetType->id.'/edit') }}"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @if($oFleetTypes->render())
                            <div class="box-footer clearfix">
                                {!! $oFleetTypes->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

