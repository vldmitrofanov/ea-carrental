@extends('admin.partials.layouts.master')
@section('title')
    Office Locations Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Office Locations
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/locations/create')}}"><i class="fa fa-plus"></i> Add Office Location</a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Showing {!! $oOfficeLocations->currentPage() !!} of {!! $oOfficeLocations->lastPage() !!} </h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>City, Address, Zip</th>
                                    <th>Available Cars</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oOfficeLocations as $index =>$oOfficeLocation)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oOfficeLocation->name }}</td>
                                        <td>{{ $oOfficeLocation->city }}, {{ $oOfficeLocation->address }}, {{ $oOfficeLocation->zip }}</td>
                                        <td>0</td>
                                        <td>{{ ($oOfficeLocation->status)?'Active':'Inactive' }}</td>
                                        <td>
                                            <a href="{{ url('admin/locations/'.$oOfficeLocation->id.'/edit') }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="{{ url('admin/locations/'.$oOfficeLocation->id.'/delete') }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @if($oOfficeLocations->render())
                            <div class="box-footer clearfix">
                                {!! $oOfficeLocations->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

