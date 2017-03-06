@extends('admin.partials.layouts.master')
@section('title')
    Clients Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Clients
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/clients/create')}}"><i class="fa fa-plus"></i> Add Client</a></li>
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
                                    <th>User Name</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Last Rental</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oUsers as $index =>$oUser)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oUser->username }}</td>
                                        <td>{{ $oUser->name }}</td>
                                        <td>{{ $oUser->email }}</td>
                                        <td>{{ $oUser->phone }}</td>
                                        <td></td>
                                        <td>
                                            <a href="{{ url('admin/clients/'.$oUser->id.'/edit') }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <?php /*<a href="{{ url('admin/users/'.$oUser->id.'/delete') }}"><i class="fa fa-trash"></i></a>*/?>
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

