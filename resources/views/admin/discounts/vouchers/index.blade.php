@extends('admin.partials.layouts.master')
@section('title')
    Vouchers Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Vouchers
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/discounts/vouchers/create')}}"><i class="fa fa-plus"></i> Add Voucher</a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Showing {!! $oDiscounts->currentPage() !!} of {!! $oDiscounts->lastPage() !!} </h3>

                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Client Name</th>
                                    <th>Car</th>
                                    <th>Car Type</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oDiscounts as $index =>$oDiscount)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oDiscount->user->code }})</td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>{{ $oDiscount->status }}</td>
                                        <td>0</td>
                                        <td>
                                            <a href="{{ url('admin/discounts/vouchers/'.$oDiscount->id.'/edit') }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="{{ url('admin/discounts/vouchers/'.$oDiscount->id.'/delete') }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @if($oDiscounts->render())
                            <div class="box-footer clearfix">
                                {!! $oDiscounts->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

