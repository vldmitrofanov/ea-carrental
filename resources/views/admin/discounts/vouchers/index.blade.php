@extends('admin.partials.layouts.master')
@section('title')
    Discount Vouchers Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Discount Vouchers
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
                        <div class="box-body">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Discount</th>
                                    <th>Dates</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oDiscounts as $index =>$oDiscount)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oDiscount->voucher_code }}</td>
                                        <td>{{ $oDiscount->amount }} {{ $oDiscount->amount_type }}</td>
                                        <td>
                                            {{ $oDiscount->recurring->repititions()->orderBy('start_repeat', 'ASC')->first()->start_repeat  }} - {{ $oDiscount->recurring->repititions()->orderBy('end_repeat', 'DESC')->first()->end_repeat  }}
                                        </td>
                                        <td>{{ ($oDiscount->status)?'Active':'In-active' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Action</button>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{ url('admin/discounts/vouchers/'.$oDiscount->id.'/show') }}"><i class="fa fa-eye"></i>Details</a></li>
                                                    <li><a href="{{ url('admin/discounts/vouchers/'.$oDiscount->id.'/edit') }}"><i class="fa fa-edit"></i>Edit</a></li>
                                                    <li><a href="{{ url('admin/discounts/vouchers/'.$oDiscount->id.'/delete') }}"><i class="fa fa-trash"></i>Delete</a></li>
                                                </ul>
                                            </div>



                                            <?php /*<a href="{{ url('admin/discounts/vouchers/'.$oDiscount->id.'/delete') }}"><i class="fa fa-trash"></i></a>*/?>
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

