@extends('admin.partials.layouts.master')
@section('title')
    Volume Based Discounts Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Volume Based Discounts
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a class="btn bg-navy" href="{{url('admin/discounts/volume/create')}}"><i class="fa fa-plus"></i> Add Discount</a></li>
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
                        <div class="box-body no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Discount</th>
                                    <th>Condition</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oDiscounts as $index =>$oDiscount)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oDiscount->name }}</td>
                                        <td>{{ $oDiscount->discount_amount }} {{ $oDiscount->discount_type }}</td>
                                        <td>{{ $oDiscount->booking_duration }} {{ $oDiscount->booking_duration_type }}</td>
                                        <td>
                                            <a class="featured" title="{{ ($oDiscount->featured)?'Mark Not Featured':'Mark Featured' }}" style="padding-left: 18px;" href="javascript:;" data-id="{{$oDiscount->id}}">
                                                @if($oDiscount->featured)
                                                    <i class="fa fa-check-square-o"></i>
                                                @else
                                                    <i class="fa fa-times-circle-o"></i>
                                                @endif
                                            </a>
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
                                                    <li><a href="{{ url('admin/discounts/volume/'.$oDiscount->id.'/edit') }}"><i class="fa fa-edit"></i>Edit</a></li>
                                                    <?php /*<a href="{{ url('admin/discounts/volume/'.$oDiscount->id.'/delete') }}"><i class="fa fa-trash"></i></a>*/?>
                                                    <li>
                                                        <a class="featured" title="{{ ($oDiscount->featured)?'Mark Not Featured':'Mark Featured' }}" style="padding-left: 18px;" href="javascript:;" data-id="{{$oDiscount->id}}">
                                                            @if($oDiscount->featured)
                                                                <i class="fa fa-check-square-o"></i>Mark Not Featured
                                                            @else
                                                                <i class="fa fa-times-circle-o"></i>Mark Features
                                                            @endif
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
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


@section('javascript')
    <script>
        $(function () {
            $( "#ctype" ).change(function(){
                window.location = ($(this).val()!='')?"?q="+$(this).val():'/admin/fleet/cars';
            });

            $(document).on("click", "a.featured", function(e) {
                var obj = $(this);
                processing();
                $.get('/admin/discounts/volume/featured/'+$(this).attr('data-id'))
                    .done(function(response){
                        displayMessageAlert(response.message, 'success', 'warning-sign');
                        if(response.data.featured==false){
                            obj.find('i').removeClass('fa-check-square-o').addClass('fa-times-circle-o');
                        }else{
                            obj.find('i').removeClass('fa-times-circle-o').addClass('fa-check-square-o');
                        }
                        $.unblockUI();
                    })
                    .fail(function(response){
                        $.unblockUI();
                        $.each(response.responseJSON, function (key, value) {
                            $.each(value, function (index, message) {
                                displayMessageAlert(message, 'danger', 'warning-sign');
                            });
                        });
                    });
            });
        });
    </script>
@endsection