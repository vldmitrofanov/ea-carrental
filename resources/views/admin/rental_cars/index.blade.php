@extends('admin.partials.layouts.master')
@section('title')
    Rental Cars Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Rental Cars
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/cars/create')}}"><i class="fa fa-plus"></i> Add Rental Car</a></li>
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
                                <div class="input-group" style="width: 200px;">
                                    <select name="ctype" id="ctype" class="form-control">
                                        <option value="">Select Car Type</option>
                                        @foreach($oCarTypes as $oCarType)
                                        <option value="{{ $oCarType->id }}" {{ ($q==$oCarType->id ) ? 'selected' : '' }}>{{ $oCarType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Registration No</th>
                                    <th>Make & Model</th>
                                    <th>Default Location</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oRentalCars as $index =>$oRentalCar)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oRentalCar->registration_number }}</td>
                                        <td>{{ $oRentalCar->make }} {{ $oRentalCar->model }}</td>
                                        <td>{{ $oRentalCar->registration_number }}</td>
                                        <td>{{ ($oRentalCar->status)?'Active':'Inactive' }}</td>
                                        <td>
                                            <a href="{{ url('admin/cars/'.$oRentalCar->id.'/edit') }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="{{ url('admin/cars/'.$oRentalCar->id.'/delete') }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
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

@section('javascript')
    <script>
        $(function () {
            $( "#ctype" ).change(function(){
                window.location = ($(this).val()!='')?"?q="+$(this).val():'/admin/cars';
            });
        });
    </script>
@endsection