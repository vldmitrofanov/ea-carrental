@extends('admin.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Reservations Management | Add Info
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Reservations
                <small>Add New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                        @include('admin.partials.errors.errors')
                    {!! Form::open(array('url' => 'admin/reservations/store', 'id' => 'car_reservation', 'method' => 'post', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal')) !!}
                        @include('admin.reservations.forms.add', ['submit_button'=>'Create'])
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" >
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
            $.post('/admin/types/remove_customrate', formData)
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

            $(document).on("change", "text#date_to", function(e) {
            alert('in')
            var formData = $('form#car_type').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            $.post('/admin/types/add_customrate', formData)
            .done(function(response){
                $("table.extra_rates").find('tbody')
                .append($('<tr id="'+(response.data.price.id)+'">')
                        .append($('<td>')
                                .append($('<input>')
                                        .attr('type', 'text')
                                        .attr('class', 'form-control')
                                        .attr('name', 'date_from['+(response.data.price.id)+']')
                                        .attr('id', 'date_from'+(response.data.price.id))
                                        .attr('style', 'width:auto')
                                )
                        )
                        .append($('<td>')
                                .append($('<input>')
                                        .attr('type', 'text')
                                        .attr('class', 'form-control')
                                        .attr('name', 'date_to['+(response.data.price.id)+']')
                                        .attr('id', 'date_to'+(response.data.price.id))
                                        .attr('style', 'width:auto')
                                )
                        )
                        .append($('<td>')
                                .append('From ')
                                .append($('<input>')
                                        .attr('type', 'number')
                                        .attr('class', 'form-control')
                                        .attr('name', 'from['+(response.data.price.id)+']')
                                        .attr('style', 'width:80px; display:inline')
                                        .attr('min', '0')
                                        .attr('max', '23')
                                )
                                .append('&nbsp;&nbsp;&nbsp;To&nbsp;')
                                .append($('<input>')
                                        .attr('type', 'number')
                                        .attr('class', 'form-control')
                                        .attr('name', 'to['+(response.data.price.id)+']')
                                        .attr('style', 'width:80px; display:inline')
                                        .attr('min', '0')
                                        .attr('max', '24')
                                )
                                .append('&nbsp;&nbsp;&nbsp;')
                                .append($('<select>')
                                        .attr('class', 'form-control')
                                        .attr('name', 'price_per['+(response.data.price.id)+']')
                                        .attr('style', 'width:80px; display:inline')
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
            $(document).on("change", "select#car_type_id", function(e) {
                $('#car_id').empty();
                $('#car_id').append("<option>Please Select</option>");
                if($(this).val()==''){
                    return;
                }
                processing();
                var formData = $('form#car_reservation').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                $.get('/api/load_car_list', { car_type_id: $(this).val() })
                .done(function(response){
                    $.each(response, function(key, element) {
                        $('#car_id').append("<option value='" + element.id +"'>" + element.make +' '+element.model+' - '+element.registration_number + "</option>");
                    });
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
            })

            $(document).on("change", "select#car_id", function(e) {
                processing();
                var formData = $('form#car_reservation').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                $.post('/admin/reservations/load_car_prices', formData)
                .done(function(response){
                    $("table.payment_detail> tbody tr:first").find('td').html(
                            moment($('#date_to').val(), "MM-DD-YYYY HH:mm").diff(moment($('#date_from').val(), "MM-DD-YYYY HH:mm"),'days')
                            + ' Days and '+moment($('#date_to').val(), "MM-DD-YYYY HH:mm").diff(moment($('#date_from').val(), "MM-DD-YYYY HH:mm"),'hours')+' Hours'
                    );
//                    $.each(response, function(key, element) {
//                        $('#car_id').append("<option value='" + element.id +"'>" + element.make +' '+element.model+' - '+element.registration_number + "</option>");
//                    });
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
            })


            $('#date_from').datetimepicker({format:'m/d/Y H:i', defaultDate:new Date() });
            $('#date_to').datetimepicker({
                format:'m/d/Y H:i', defaultDate:new Date(),
                onChangeDateTime:function(dp,$input){
                    $("table.payment_detail> tbody tr:first").find('td').html(
                        moment($('#date_to').val(), "MM-DD-YYYY HH:mm").diff(moment($('#date_from').val(), "MM-DD-YYYY HH:mm"),'days')
                        + ' Days and '+moment($('#date_to').val(), "MM-DD-YYYY HH:mm").diff(moment($('#date_from').val(), "MM-DD-YYYY HH:mm"),'hours')+' Hours'
                    );
                }
            });
        });
    </script>
@endsection