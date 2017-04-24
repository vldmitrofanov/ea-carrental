@extends('admin.partials.layouts.master')
@section('title')
    {{ $oDiscount->voucher_code }} Voucher Repetition Details | Vouchers Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ $oDiscount->voucher_code }} Voucher Repetition
                <small>Details</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/discounts/vouchers')}}"><i class="fa fa-backward"></i> Back </a></li>
            </ol>
        </section>


        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Start At</th>
                                    <th>End At</th>
                                </tr>
                                @foreach($oDiscount->recurring->repititions()->orderBy('start_repeat', 'ASC')->get() as $index =>$oRepetition)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oDiscount->voucher_code }}</td>
                                        <td>{{ $oRepetition->start_repeat }}</td>                                        
                                        <td>{{ $oRepetition->end_repeat }}</td>                                        
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

