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
                     <input type="hidden" name="rental_days" id="rental_days">
                     <input type="hidden" name="rental_hours" id="rental_hours">
                     <input type="hidden" name="price_per_day" id="price_per_day">
                     <input type="hidden" name="price_per_day_detail" id="price_per_day_detail">
                     <input type="hidden" name="price_per_hour" id="price_per_hour">
                     <input type="hidden" name="price_per_hour_detail" id="price_per_hour_detail">
                     <input type="hidden" name="car_rental_fee" id="car_rental_fee">
                     <input type="hidden" name="extra_price" id="extra_price">
                     <input type="hidden" name="insurance" id="insurance">
                     <input type="hidden" name="sub_total" id="sub_total">
                     <input type="hidden" name="tax" id="tax">
                     <input type="hidden" name="total_price" id="total_price">
                     <input type="hidden" name="required_deposit" id="required_deposit">
                     <input type="hidden" name="passport" id="passport" value="">
                     <input type="hidden" name="licence" id="licence" value="">
                     <input type="hidden" name="rental_form" id="rental_form" value="">
                     <input type="hidden" name="discount" id="discount" value="">
                     <input type="hidden" name="discount_detail" id="discount_detail" value="">
                     <input type="hidden" name="freebies_detail" id="freebies_detail" value="">

                        @include('admin.reservations.forms.add', ['submit_button'=>'Create'])
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/su.min.js') }}"></script>
    <script type="text/javascript" >
        $(document).ready(function(){
            $(document).on("change", "select#car_type_id", function(e) {
                $('#models').empty();
                $('#models').append("<option>Select Make & Model</option>");
                if($(this).val()==''){
                    return;
                }
                processing();
                $.get('/api/load_car_models_list', { car_type_id: $(this).val() })
                .done(function(response){
                    var cars = response.data.cars;
                    $.each(cars, function(key, element) {
                        $('#models').append("<option value='" + element.id +"'>" + element.make +' - '+element.model+ "</option>");
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
            });

            $(document).on("change", "select#models", function(e) {
                $('#car_id').empty();
                $('#car_id').append("<option>Select Car</option>");
                if($(this).val()==''){
                    return;
                }
                processing();
                $.get('/api/load_model_cars_list', { model_id: $(this).val() })
                .done(function(response){
                    var cars = response.data.cars;
                    $.each(cars, function(key, element) {
                        $('#car_id').append("<option value='" + element.id +"'>" + element.registration_number +"</option>");
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
            });

            $(document).on("click", "button.validate-code", function(e) {
                processing();
                var formData = $('form#car_reservation').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                $.post('/admin/reservations/validate_voucher', formData)
                        .done(function(response){
                            $.unblockUI();
                            displayMessageAlert(response.message);
                        })
                        .fail(function(response){
                            $('#discount_code').val('');
                            $.unblockUI();
                            $.each(response.responseJSON, function (key, value) {
                                $.each(value, function (index, message) {
                                    displayMessageAlert(message, 'danger', 'warning-sign');
                                });
                            });
                        });
            });

            $(document).on("click", "button.calculate-prices", function(e){
                $('select#car_id').trigger('change');
            })

            $('input[type=file]').change(function(){
                $(this).simpleUpload("/admin/reservations/upload", {
                    allowedExts: ["jpg", "jpeg", "png", "gif"],
                    data : {
                        _token : $('input[name="_token"]').val(),
                        type: "post"
                    },
                    start: function(file){
                        $('#filename').html(file.name);
                        $('#progress').html("");
                        $('#progressBar').width(0);
                    },

                    progress: function(progress){
                        $('#progress').html("Progress: " + Math.round(progress) + "%");
                        $('#progressBar').width(progress + "%");
                    },

                    success: function(data){
                        $('#progress').html("Success!<br>Data: " + data.message);
                        $('#'+data.data.type).val(data.data.file);
                    },

                    error: function(error){
                        $('#progress').html("Failure!<br>" + error.name + ": " + error.message);
                    }

                });

            });

        });
        
        $(document).on("click", "button.save-reservation", function(e) {
            var formData = $('form#car_reservation').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            $.post('/admin/reservations/store', formData)
            .done(function(response){
                displayMessageAlert(response.message);
                redirectPage('/admin/reservations')
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
        function addExtra(obj) {
            $('select#car_id').trigger('change');
        }
        function calculatePrices(){
            processing();
            var formData = $('form#car_reservation').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            $.post('/admin/reservations/calculate_difference', formData)
                    .done(function(response){
                        $('#rental_days').val(response.days);
                        $('#rental_hours').val(response.hours);

                        $("table.payment_detail> tbody tr:first").find('td').html(
                                response.days+" Days and "+ response.hours+" Hours"
                        );
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
        }

        $( document ).ready(function() {
            $(document).on("click", "a.remove-extra", function(e) {
                $("table.extras-table > tbody").find('tr#'+$(this).attr('data-id')).remove();
                $('select#car_id').trigger('change');
            });

            $(document).on("click", "button.add-extra", function(e) {
                if($('#models').val()==''){
                    return;
                }
                processing();
                var formData = $('form#car_reservation').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                $.get('/api/load_extras', { car_model_id: $('#models').val() })
                .done(function(response){
                    var extras = response.data.extras;
                    var currency = response.data.currency;
                    var id = $.now();

                        $("table.extras-table").find('tbody')
                            .append($('<tr id="'+id+'">')
                                .append($('<td>')
                                    .append($('<div>')
                                        .attr('class', 'form-group')
                                        .append($('<label>')
                                            .attr('class', 'col-sm-2 control-label')
                                        )
                                        .append($('<div>')
                                            .attr('class', 'col-sm-4')
                                            .append($('<select>')
                                                    .attr('class', 'form-control')
                                                    .attr('onchange', 'addExtra(this)')
                                                    .attr('name', 'extra_id['+id+']')
                                                    .attr('id', 'extra_id_'+id+'')
                                                    .append($("<option></option>")
                                                            .attr("value",'')
                                                            .text('Choose Extra')
                                                    )
                                            )
                                        )
                                        .append($('<div>')
                                            .attr('class', 'col-sm-3')
                                            .append($('<select>')
                                                    .attr('class', 'form-control')
                                                    .attr('onchange', 'addExtra(this)')
                                                    .attr('name', 'extra_cnt['+id+']')
                                                    .attr('id', 'extra_cnt_'+id+'')
                                                    .append($("<option></option>")
                                                        .attr("value", '1')
                                                        .text('1')
                                                    ).append($("<option></option>")
                                                        .attr("value", '2')
                                                        .text('2')
                                                    ).append($("<option></option>")
                                                        .attr("value", '3')
                                                        .text('3')
                                                    ).append($("<option></option>")
                                                        .attr("value", '4')
                                                        .text('4')
                                                    ).append($("<option></option>")
                                                            .attr("value", '5')
                                                            .text('5')
                                                    ).append($("<option></option>")
                                                            .attr("value", '6')
                                                            .text('6')
                                                    ).append($("<option></option>")
                                                            .attr("value", '7')
                                                            .text('7')
                                                    ).append($("<option></option>")
                                                            .attr("value", '8')
                                                            .text('8')
                                                    ).append($("<option></option>")
                                                            .attr("value", '9')
                                                            .text('9')
                                                    ).append($("<option></option>")
                                                            .attr("value", '10')
                                                            .text('10')
                                                    )
                                            )
                                        )
                                        .append($('<div>')
                                            .attr('class', 'col-sm-2')
                                            .append('<a href="javascript:;" class="remove-extra"  data-id="'+id+'"><i class="fa fa-trash" style="padding-top: 8px;"></i></a>')
                                        )

                                    )


                                )
                        );


                    $.each(extras, function(key, element) {
                        $('#extra_id_'+id).append("<option data-currency='"+currency+"' data-per='"+element.per+"' data-price='"+ element.price +"' value="+ element.id +">" + element.name + "</option>");
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
            });

            /*$(document).on("change", "select#car_type_id", function(e) {
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
                    var cars = response.data.cars;
                    $.each(cars, function(key, element) {
                        $('#car_id').append("<option value='" + element.id +"'>" + element.make +' '+element.model+' - '+element.registration_number + "</option>");
                    });

//                    $.each(cars, function(key, element) {
//                        $("div.reservation-fields > div:nth-child(9)").after("<div>foobar</div>");
////                        $('#car_id').append("<option value='" + element.id +"'>" + element.make +' '+element.model+' - '+element.registration_number + "</option>");
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
            })*/

            $(document).on("change", "select#car_id", function(e) {
                processing();
                var formData = $('form#car_reservation').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                $.post('/admin/reservations/load_car_prices', formData)
                .done(function(response){
                    var prices = response.data.prices;
                    var currency = response.data.currency;
                    var currencySign = response.data.currencySign;

                    $('#price_per_day').val(prices.price_per_day);
                    $('#price_per_day_detail').val(prices.price_per_day_detail);
                    $('#price_per_hour').val(prices.price_per_hour);
                    $('#price_per_hour_detail').val(prices.price_per_hour_detail);
                    $('#car_rental_fee').val(prices.car_rental_fee);
                    $('#extra_price').val(prices.extra_price);
                    $('#insurance').val(prices.insurance);
                    $('#sub_total').val(prices.sub_total);
                    $('#tax').val(prices.tax);
                    $('#total_price').val(prices.total_price);
                    $('#required_deposit').val(prices.required_deposit);
                    $('#discount').val(prices.discount);
                    $('#discount_detail').val(prices.discount_detail);
                    
                    if(prices.hasVDiscount==true){
                        $('#discount_code').prop('disabled', true);
                        $('#discount_code').val('');
                        $('.validate-code').prop('disabled', true);
                    }else{
                        $('#discount_code').prop('disabled', false);
                        $('.validate-code').prop('disabled', false);
                    }

                    $("table.payment_detail> tbody tr:nth-child(2)").find('th').html('Price per day:<br/><small>'+prices.price_per_day_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(2)").find('td').html(currencySign+' '+prices.price_per_day);

                    $("table.payment_detail> tbody tr:nth-child(3)").find('th').html('Price per hour:<br/><small>'+prices.price_per_hour_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(3)").find('td').html(currencySign+' '+prices.price_per_hour);

                    $("table.payment_detail> tbody tr:nth-child(4)").find('th').html('Discount:<br/><small>'+prices.discount_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(4)").find('td').html(currencySign+' '+prices.discount);

                    $("table.payment_detail> tbody tr:nth-child(5)").find('th').html('Car rental fee:<br/><small>'+prices.car_rental_fee_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(5)").find('td').html(currencySign+' '+prices.car_rental_fee);


                    $("table.payment_detail> tbody tr:nth-child(6)").find('td').html(currencySign+' '+prices.extra_price);

                    $("table.payment_detail> tbody tr:nth-child(7)").find('th').html('Insurance:<br/><small>'+prices.insurance_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(7)").find('td').html(currencySign+' '+prices.insurance);

                    $("table.payment_detail> tbody tr:nth-child(8)").find('td').html(currencySign+' '+prices.sub_total);

                    $("table.payment_detail> tbody tr:nth-child(9)").find('th').html('Tax:<br/><small>'+prices.tax_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(9)").find('td').html(currencySign+' '+prices.tax);

                    $("table.payment_detail> tbody tr:nth-child(10)").find('td').html(currencySign+' '+prices.total_price);
                    $("table.payment_detail> tbody tr:nth-child(11)").find('td').html(currencySign+' '+prices.required_deposit);

                    if(prices.hasFreeBies){
                        $("table.payment_detail> tbody tr:nth-child(12)").find('td').html(prices.oFreeBies.name);
                        $('#freebies_detail').val(prices.oFreeBies.name);
                    }else{
                        $("table.payment_detail> tbody tr:nth-child(12)").find('td').html('');
                        $('#freebies_detail').val();
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
                    
//                    $('input#date_from').val('');
//                    $('input#date_to').val('');
                });
            });

            $('#date_from').datetimepicker({
                format:'m/d/Y H:i', defaultDate:new Date(),
                defaultTime:'10:00',
                onChangeDateTime:function(dp,$input){
                    calculatePrices();
                }
            });
            $('#date_to').datetimepicker({
                format:'m/d/Y H:i', defaultDate:new Date(),
                defaultTime:'18:00',
                onChangeDateTime:function(dp,$input){
//                    $("table.payment_detail> tbody tr:first").find('td').html(
//                        moment($('#date_to').val(), "MM-DD-YYYY HH:mm").diff(moment($('#date_from').val(), "MM-DD-YYYY HH:mm"),'days')
//                        + ' Days and '+moment($('#date_to').val(), "MM-DD-YYYY HH:mm").diff(moment($('#date_from').val(), "MM-DD-YYYY HH:mm"),'hours')+' Hours'
//                    );
                    calculatePrices();
                }
            });
        });
    </script>
@endsection