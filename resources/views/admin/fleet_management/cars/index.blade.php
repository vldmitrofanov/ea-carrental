@extends('admin.partials.layouts.master')
@section('title')
    Car Inventory Management
@endsection
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Inventory
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/fleet/cars/create')}}"><i class="fa fa-plus"></i> Add Rental Car</a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Showing {!! $oRentalCars->currentPage() !!} of {!! $oRentalCars->lastPage() !!} </h3>
                            <div class="box-tools">
                                <div class="input-group" style="width: auto;">
                                    <select name="ctype" id="ctype" class="form-control">
                                        <option value="">Select Car Type</option>
                                        @foreach($oTypes as $oType)
                                        <option value="{{ $oType->id }}" {{ ($q==$oType->id ) ? 'selected' : '' }}>{{ ($oType->vehicleSize)?$oType->vehicleSize->code_letter:'-'  }}{{ ($oType->vehicleDoors)?$oType->vehicleDoors->code_letter:'-'  }}{{ ($oType->vehicleTransmissionAndDrive)?$oType->vehicleTransmissionAndDrive->code_letter:'-'  }}{{ ($oType->vehicleFuelAndAC)?$oType->vehicleFuelAndAC->code_letter:'-'  }}(
                                            {{ ($oType->vehicleSize)?$oType->vehicleSize->description.'|':'-'  }}
                                            {{ ($oType->vehicleDoors)?$oType->vehicleDoors->description.'|':'-'  }}
                                            {{ ($oType->vehicleTransmissionAndDrive)?$oType->vehicleTransmissionAndDrive->description.'|':'-'  }}
                                            {{ ($oType->vehicleFuelAndAC)?$oType->vehicleFuelAndAC->description:'-'  }}
                                            )</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table id="carInventoryTbl" cellspacing="0" width="100%" class="display table table-hover">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Registration No</th>
                                    <th>Make & Model</th>
                                    <th>Default Location</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($oRentalCars as $index =>$oRentalCar)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oRentalCar->registration_number }}</td>
                                        <td>{{ $oRentalCar->makeAndModel->make }} {{ $oRentalCar->makeAndModel->model }}</td>
                                        <td>{{ $oRentalCar->location->name }}</td>
                                        <td>
                                            <a class="featured" title="{{ ($oRentalCar->featured)?'Mark Not Featured':'Mark Featured' }}" style="padding-left: 18px;" href="javascript:;" data-id="{{$oRentalCar->id}}">
                                            @if($oRentalCar->featured)
                                                <i class="fa fa-check-square-o"></i>
                                            @else
                                                <i class="fa fa-times-circle-o"></i>
                                            @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a class="publish" title="{{ ($oRentalCar->status)?'Mark Unpublish':'Mark Publish' }}" style="padding-left: 18px;" href="javascript:;" data-id="{{$oRentalCar->id}}">
                                                @if($oRentalCar->status)
                                                    <i class="fa fa-check-square-o"></i>
                                                @else
                                                    <i class="fa fa-times-circle-o"></i>
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/fleet/cars/'.$oRentalCar->id.'/edit') }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="{{ url('admin/fleet/cars/'.$oRentalCar->id.'/delete') }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($oRentalCars->render())
                            <div class="box-footer clearfix">
                                {!! $oRentalCars->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<?php /*
@section('javascript')
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <script src="{{ asset('administration/dist/js/carinventory.js') }}"></script>
@endsection
*/ ?>
@section('javascript')
    <script>
        $(function () {
            $( "#ctype" ).change(function(){
                window.location = ($(this).val()!='')?"?q="+$(this).val():'/admin/fleet/cars';
            });

            $(document).on("click", "a.featured", function(e) {
                var obj = $(this);
                processing();
                $.get('/admin/fleet/cars/featured/'+$(this).attr('data-id'))
                .done(function(response){
                    displayMessageAlert(response.message, 'success', 'warning-sign');
                    if(response.data.featured==false){
                        obj.find('i').removeClass('fa-check-square-o').addClass('fa-times-circle-o');
                    }else{
                        obj.find('i').removeClass('fa-times-circle-o').addClass('fa-check-square-o');
                    }
                    $.unblockUI();
                })
                .fail(function(response){
                    $.unblockUI();
                    $.each(response.responseJSON, function (key, value) {
                        $.each(value, function (index, message) {
                            displayMessageAlert(message, 'danger', 'warning-sign');
                        });
                    });
                });
            });

            $(document).on("click", "a.publish", function(e) {
                var obj = $(this);
                processing();
                $.get('/admin/fleet/cars/publish/'+$(this).attr('data-id'))
                        .done(function(response){
                            displayMessageAlert(response.message, 'success', 'warning-sign');
                            if(response.data.status==false){
                                obj.find('i').removeClass('fa-check-square-o').addClass('fa-times-circle-o');
                            }else{
                                obj.find('i').removeClass('fa-times-circle-o').addClass('fa-check-square-o');
                            }
                            $.unblockUI();
                        })
                        .fail(function(response){
                            $.unblockUI();
                            $.each(response.responseJSON, function (key, value) {
                                $.each(value, function (index, message) {
                                    displayMessageAlert(message, 'danger', 'warning-sign');
                                });
                            });
                        });
            });
        });
    </script>
@endsection