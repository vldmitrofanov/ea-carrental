@extends('admin.partials.layouts.master')
@section('title')
    Vouchers Management | Add New
@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('administration/plugins/select2/select2.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Vouchers
                <small>Create New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.partials.errors.errors')
                    {!! Form::model($oDiscount, array('url' =>array('admin/discounts/volume/update', $oDiscount->id), 'id' => 'vouchers', 'method' => 'PATCH', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal')) !!}
                    <input type="hidden" name="voucher" id="voucher" value="{{ $oDiscount->id}}">
                    @include('admin.discounts.volumes.forms.edit', ['submit_button'=>'Submit'])
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
<script src="{{ asset('administration/plugins/select2/select2.full.min.js')}}"></script>

<script type="text/javascript" >
    $(document).ready(function(){
        $(".select2").select2();

        $('#start_date').datetimepicker({format:'m/d/Y', defaultDate:new Date(),timepicker:false,});
        $('#end_date').datetimepicker({format:'m/d/Y', defaultDate:new Date(),timepicker:false,});

        $(document).on("click", "button.save-voucher", function(e) {
            var formData = $('form#vouchers').serializeArray();
            $.post($('form#vouchers').attr('action'), formData)
                    .done(function(response){
                        displayMessageAlert(response.message);
                        redirectPage('/admin/discounts/volume')
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

        $('#frequency').trigger('change');
    });
    
    
</script>
@endsection