@extends('admin.partials.layouts.master')
@section('title')
Car Type Extras Management
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Extras
            <small>Management</small>
        </h1>
        <ol class="breadcrumb">
            <li><a class="btn bg-navy" href="{{url('admin/extras/create')}}"><i class="fa fa-plus"></i> Add Extras</a></li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            @include('admin.partials.errors.errors')
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Showing {!! $oCarExtras->currentPage() !!} of {!! $oCarExtras->lastPage() !!} </h3>
                        
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>&nbsp;</th>
                            </tr>
                            @foreach($oCarExtras as $index =>$oCarExtra)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $oCarExtra->name }}</td>
                                <td>{{ $oCarExtra->price }}</td>
                                <td><a href="{{ url('admin/extras/'.$oCarExtra->id.'/edit') }}"><i class="fa fa-edit"></i></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    @if($oCarExtras->render())
                    <div class="box-footer clearfix">                       
                        {!! $oCarExtras->render() !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

