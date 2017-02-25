@extends('admin.partials.layouts.master')
@section('title')
    Users Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Users
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/users/create')}}"><i class="fa fa-plus"></i> Add User</a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Showing {!! $oUsers->currentPage() !!} of {!! $oUsers->lastPage() !!} </h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registration date/time</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oUsers as $index =>$oUser)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oUser->name }}</td>
                                        <td>{{ $oUser->email }}</td>
                                        <td>{{ $oUser->created_at }}</td>
                                        <td>{{ ($oUser->status)?'Active':'Inactive' }}</td>
                                        <td>
                                            <a href="{{ url('admin/users/'.$oUser->id.'/edit') }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="{{ url('admin/users/'.$oUser->id.'/delete') }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @if($oUsers->render())
                            <div class="box-footer clearfix">
                                {!! $oUsers->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

