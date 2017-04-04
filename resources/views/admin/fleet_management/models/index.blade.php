@extends('admin.partials.layouts.master')
@section('title')
    Car Make & Model Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Make & Model
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/fleet/models/create')}}"><i class="fa fa-plus"></i> Add Make & Model</a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Showing {!! $oCarModels->currentPage() !!} of {!! $oCarModels->lastPage() !!} </h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>SIPP Code</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oCarModels as $index =>$oCarModel)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            <img width="90px"
                                                 src="{{asset($oCarModel->thumb_path)}}"
                                                 alt="{{ $oCarModel->name }}">
                                        </td>
                                        <td>
                                            {{ ($oCarModel->SIPPCode->first())?$oCarModel->SIPPCode->first()->vehicleSize->code_letter:'-'  }}
                                            {{ ($oCarModel->SIPPCode->first())?$oCarModel->SIPPCode->first()->vehicleDoors->code_letter:'-'  }}
                                            {{ ($oCarModel->SIPPCode->first())?$oCarModel->SIPPCode->first()->vehicleTransmissionAndDrive->code_letter:'-'  }}
                                            {{ ($oCarModel->SIPPCode->first())?$oCarModel->SIPPCode->first()->vehicleFuelAndAC->code_letter:'-'  }}
                                        </td>
                                        <td>{{ $oCarModel->make }}</td>
                                        <td>{{ $oCarModel->model }}</td>
                                        <td><a href="{{ url('admin/fleet/models/'.$oCarModel->id.'/edit') }}"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @if($oCarModels->render())
                            <div class="box-footer clearfix">
                                {!! $oCarModels->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

