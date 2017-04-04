@extends('admin.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Car Make & Model Management Management | Update Info
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Make & Model Management
                <small>Update Info</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                        @include('admin.partials.errors.errors')
                        {!! Form::model($oCarModel, array('url' =>array('admin/fleet/models/update', $oCarModel->id), 'id' => 'car_type', 'method' => 'PATCH', 'enctype'=>'multipart/form-data', 'class' => "form-horizontal")) !!}
                        {{ Form::hidden('id',$oCarModel->id ) }}
                        @include('admin.fleet_management.models.forms.edit', ['submit_button'=>'Submit'])
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" >
        $(document).ready(function(){
            $(document).on("change", "select#type_id", function(e) {
                if($(this).find(':selected').data('transmission')==''){
                    $('#transmission').val('');
                }else{
                    $('#transmission').val($(this).find(':selected').data('transmission'));
                }

                if($(this).find(':selected').data('doors')==''){
                    $('#total_doors').val('');
                }else{
                    $('#total_doors').val($(this).find(':selected').data('doors'));
                }
            });
        });
        $(document).on("click", "a.remove-extra", function(e) {
            processing();
            var formData = $('form#car_type').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            formData.push({
                name: "extra_id",
                value: $(this).attr('data-id')
            });
            $.post('/admin/fleet/models/remove_customrate', formData)
                    .done(function(response){
                        $.unblockUI();
                        displayMessageAlert('Custom Rate information removed.');
                    })
                    .fail(function(response){
                        $.unblockUI();
                        $.each(response.responseJSON, function (key, value) {
                            $.each(value, function (index, message) {
                                displayMessageAlert(message, 'danger', 'warning-sign');
                            });
                        });
                    });

            $('table.extra_rates tr#'+$(this).attr('data-id')).remove();
        })
        function initializeDT() {
            $('.table.extra_rates>tbody tr').each(function (i, row) {
                $('#date_from'+$(row).attr('id')).datepicker({
                    autoclose: true,
                    format: "mm/dd/yyyy",
                    todayHighlight: true
                });
                $('#date_to'+$(row).attr('id')).datepicker({
                    autoclose: true,
                    format: "mm/dd/yyyy",
                    todayHighlight: true
                });
            });
        }
        $(document).on("click", "button.btn-add-rate", function(e) {
            var formData = $('form#car_type').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            $.post('/admin/fleet/models/add_customrate', formData)
                    .done(function(response){
                        $("table.extra_rates").find('tbody')
                                .append($('<tr id="'+(response.data.price.id)+'">')
                                        .append($('<td>')
                                                .append($('<input>')
                                                        .attr('type', 'text')
                                                        .attr('class', 'form-control')
                                                        .attr('name', 'date_from['+(response.data.price.id)+']')
                                                        .attr('id', 'date_from'+(response.data.price.id))
                                                        .attr('style', 'width:135px')
                                                )
                                        )
                                        .append($('<td>')
                                                .append($('<input>')
                                                        .attr('type', 'text')
                                                        .attr('class', 'form-control')
                                                        .attr('name', 'date_to['+(response.data.price.id)+']')
                                                        .attr('id', 'date_to'+(response.data.price.id))
                                                        .attr('style', 'width:135px')
                                                )
                                        )
                                        .append($('<td>')
                                                .append('From ')
                                                .append($('<input>')
                                                        .attr('type', 'number')
                                                        .attr('class', 'form-control')
                                                        .attr('name', 'from['+(response.data.price.id)+']')
                                                        .attr('style', 'width:65px; display:inline')
                                                        .attr('min', '0')
                                                        .attr('max', '23')
                                                )
                                                .append('&nbsp;&nbsp;&nbsp;To&nbsp;')
                                                .append($('<input>')
                                                        .attr('type', 'number')
                                                        .attr('class', 'form-control')
                                                        .attr('name', 'to['+(response.data.price.id)+']')
                                                        .attr('style', 'width:65px; display:inline')
                                                        .attr('min', '0')
                                                        .attr('max', '24')
                                                )
                                                .append('&nbsp;&nbsp;&nbsp;')
                                                .append($('<select>')
                                                        .attr('class', 'form-control')
                                                        .attr('name', 'price_per['+(response.data.price.id)+']')
                                                        .attr('style', 'width:65px; display:inline')
                                                        .append($("<option></option>")
                                                                .attr("value",'hour')
                                                                .text('Hours')
                                                        )
                                                        .append($("<option></option>")
                                                                .attr("value",'day')
                                                                .text('Days')
                                                        )
                                                )
                                        )
                                        .append($('<td>')
                                                .append($('<input>')
                                                        .attr('type', 'text')
                                                        .attr('class', 'form-control')
                                                        .attr('name', 'price['+(response.data.price.id)+']')
                                                        .attr('style', 'width:80px;display:inline')
                                                )
                                                .append('&nbsp;&nbsp;per&nbsp;<span id="price-type">Hour</span>')
                                        )
                                        .append($('<td>')
                                                .append('<a href="javascript:;" class="remove-extra" data-id="'+(response.data.price.id)+'" ><i class="fa fa-trash"></i></a>')
                                        )
                                );
                        initializeDT();
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
        $( document ).ready(function() {
            initializeDT();
        });
    </script>
@endsection