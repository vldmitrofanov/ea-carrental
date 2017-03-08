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
                    {!! Form::open(array('url' => 'admin/discounts/vouchers/store', 'id'=>'vouchers', 'method' => 'post', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal')) !!}
                    @include('admin.discounts.vouchers.forms.add', ['submit_button'=>'Create'])
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
        
        $('#date_from').datetimepicker({format:'m/d/Y H:i', defaultDate:new Date()});
        $('#date_to').datetimepicker({format:'m/d/Y H:i', defaultDate:new Date()});
        $('#recurrence_end').datetimepicker({format:'m/d/Y', defaultDate:new Date(),timepicker:false});

        $(document).on("change", "select#frequency", function(e) {
            $('tr#daily_recur').addClass('hidden');
            $('tr#weekly_recur').addClass('hidden');
            $('tr#monthly_recur').addClass('hidden');
            $('tr#end_recur').addClass('hidden');

            switch ($(this).val()){
                case"daily":
                        $('tr#daily_recur').removeClass('hidden');
                        $('tr#end_recur').removeClass('hidden');
                    break;
                case"weekly":
                        $('tr#weekly_recur').removeClass('hidden');
                        $('tr#end_recur').removeClass('hidden');
                    break;
                case"monthly":
                        $('tr#monthly_recur').removeClass('hidden');
                        $('tr#end_recur').removeClass('hidden');
                    break;
            }
        });

        $(document).on("click", "button.save-voucher", function(e) {
            var formData = $('form#vouchers').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            $.post($('form#vouchers').attr('action'), formData)
                    .done(function(response){
                        displayMessageAlert(response.message);
                        redirectPage('/admin/discounts/vouchers')
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