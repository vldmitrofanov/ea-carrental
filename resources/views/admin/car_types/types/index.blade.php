@extends('admin.partials.layouts.master')
@section('title')
    Car Types Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Types
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/types/create')}}"><i class="fa fa-plus"></i> Add Type</a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Showing {!! $oCarTypes->currentPage() !!} of {!! $oCarTypes->lastPage() !!} </h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th>Car models</th>
                                    <th>Number of cars</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oCarTypes as $index =>$oCarType)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                            <img width="90px"
                                                 src="{{asset($oCarType->thumb_path)}}"
                                                 alt="{{ $oCarType->name }}">
                                        </td>
                                        <td>{{ $oCarType->name }}</td>
                                        <td>
                                            <span style="margin-right: 5px;" class="attribute attribute-passengers pull-left">{{ $oCarType->total_passengers }}</span>&nbsp;
                                            <span style="margin-right: 5px;" class="attribute attribute-luggages pull-left">{{ $oCarType->total_bags }}</span>&nbsp;
                                            <span style="margin-right: 5px;" class="attribute attribute-doors pull-left">{{ $oCarType->total_doors }}</span>&nbsp;
                                            <span class="attribute attribute-transmission pull-left">{{ config('settings.transmission')[$oCarType->transmission] }}</span>
                                        </td>
                                        <td>0</td>
                                        <td>{{ ($oCarType->status)?'Active':'Inactive' }}</td>
                                        <td><a href="{{ url('admin/types/'.$oCarType->id.'/edit') }}"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @if($oCarTypes->render())
                            <div class="box-footer clearfix">
                                {!! $oCarTypes->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

