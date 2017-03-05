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
                <small>Edit Information</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.partials.errors.errors')
                    {!! Form::model($oReservation, array('url' =>array('admin/reservations/update', $oReservation->id), 'id' => 'car_reservation', 'method' => 'PATCH', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal')) !!}
                     <input type="hidden" name="rental_days" id="rental_days" value="{{ $oReservation->details->first()->rental_days  }}">
                     <input type="hidden" name="rental_hours" id="rental_hours" value="{{ $oReservation->details->first()->rental_hours  }}">
                     <input type="hidden" name="price_per_day" id="price_per_day" value="{{ $oReservation->details->first()->price_per_day  }}">
                     <input type="hidden" name="price_per_day_detail" id="price_per_day_detail" value="{{ $oReservation->details->first()->price_per_day_detail  }}">
                     <input type="hidden" name="price_per_hour" id="price_per_hour" value="{{ $oReservation->details->first()->price_per_hour  }}">
                     <input type="hidden" name="price_per_hour_detail" id="price_per_hour_detail" value="{{ $oReservation->details->first()->price_per_hour_detail  }}">
                     <input type="hidden" name="car_rental_fee" id="car_rental_fee" value="{{ $oReservation->details->first()->car_rental_fee  }}">
                     <input type="hidden" name="extra_price" id="extra_price" value="{{ $oReservation->details->first()->extra_price  }}">
                     <input type="hidden" name="insurance" id="insurance" value="{{ $oReservation->details->first()->insurance }}">
                     <input type="hidden" name="sub_total" id="sub_total" value="{{ $oReservation->details->first()->sub_total }}">
                     <input type="hidden" name="tax" id="tax" value="{{ $oReservation->details->first()->tax }}">
                     <input type="hidden" name="total_price" id="total_price" value="{{ $oReservation->details->first()->total_price }}">
                     <input type="hidden" name="required_deposit" id="required_deposit" value="{{ $oReservation->details->first()->required_deposit }}">
                     <input type="hidden" name="extra_hours_usage" id="extra_hours_usage" value="{{ $oReservation->details->first()->extra_hours_usage }}">
                     <input type="hidden" name="id" id="id" value="{{ $oReservation->id}}">
                     <input type="hidden" name="currency_sign" id="currency_sign" value="{{ $currencySign }}">
                     <input type="hidden" name="payment_made" id="payment_made" value="{{ ($oReservation->payments->where('status','paid')->sum('amount'))?:0 }}">

                        @include('admin.reservations.forms.edit', ['submit_button'=>'Create'])
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" >
        $(document).on("click", "button.save-reservation", function(e) {
            var formData = $('form#car_reservation').serializeArray();
            formData.push({
                name: "_method",
                value: "patch"
            });
            $.post($('form#car_reservation').attr('action'), formData)
            .done(function(response){
                displayMessageAlert(response.message);
//                pageRefresh()
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
        $(document).on("click", "a.remove-payment", function(e) {
            processing();
            var paymentId = $(this).attr('data-id');
            var formData = $('form#car_reservation').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            formData.push({
                name: "payment_id",
                value: paymentId
            });
            $.post('/admin/reservations/remove_payment', formData)
            .done(function(response){
                $('div.payment-made').html($('#currency_sign').val()+ ' ' +response.data.amountPaid)
                $('table.payments').find('tr#'+paymentId).remove();
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

                        $('select#car_id').trigger('change');
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
            $(document).on("click", "button.btn-add-payment", function(e) {
                var formData = $('form#car_reservation').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                $.post('/admin/reservations/add_payment', formData)
                        .done(function(response){
                            $("table.payments").find('tbody')
                                    .append($('<tr id="'+(response.data.payment.id)+'">')
                                            .append($('<td>')
                                                    .append($('<select>')
                                                            .attr('class', 'form-control')
                                                            .attr('name', 'payment_method['+response.data.payment.id+']')
                                                            .append($("<option></option>")
                                                                    .attr("value", 'paypal')
                                                                    .text('Paypal')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'authorize')
                                                                    .text('Authorize.net')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'creditcard')
                                                                    .text('Credit Card')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'bank')
                                                                    .text('Bank')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'cash')
                                                                    .attr("selected", 'selected')
                                                                    .text('Cash')
                                                            )
                                                    )
                                            )
                                            .append($('<td>')
                                                    .append($('<select>')
                                                            .attr('class', 'form-control')
                                                            .attr('name', 'payment_type['+response.data.payment.id+']')
                                                            .append($("<option></option>")
                                                                    .attr("value", 'online')
                                                                    .text('Online booking')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'balance')
                                                                    .attr("selected", 'selected')
                                                                    .text('Payment')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'securitypaid')
                                                                    .text('Security deposit paid')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'securityreturned')
                                                                    .text('Security deposit returned')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'delay')
                                                                    .text('Delay fee')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'extra')
                                                                    .text('Extra mileage')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'additional')
                                                                    .text('Additional charges')
                                                            )
                                                    )
                                            )
                                            .append($('<td>')
                                                    .append($('<input>')
                                                            .attr('class', 'form-control')
                                                            .attr('name', 'payment_amount['+response.data.payment.id+']')
                                                            .attr('value', '0')
                                                    )
                                            )
                                            .append($('<td>')
                                                    .append($('<select>')
                                                            .attr('class', 'form-control')
                                                            .attr('name', 'payment_status['+response.data.payment.id+']')
                                                            .append($("<option></option>")
                                                                    .attr("value", 'paid')
                                                                    .text('Paid')
                                                            ).append($("<option></option>")
                                                                    .attr("value", 'notpaid')
                                                                    .text('Not paid')
                                                            )
                                                    )
                                            )

                                            .append($('<td>')
                                                    .append('<a href="javascript:;" class="remove-payment" data-id="'+(response.data.payment.id)+'" ><i class="fa fa-trash"></i></a>')
                                            )
                                    );
                            alert(response.data.amountPaid);
                            $('div.payment-made').html($('#currency_sign').val()+' '+response.data.amountPaid);

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

            $(document).on("click", "a.set-mileage", function(e) {
                $('#pickup_mileage').val($(this).attr('data-mileage'));
            });

            $(document).on("click", "a.remove-extra", function(e) {
                $("table.extras-table > tbody").find('tr#'+$(this).attr('data-id')).remove();
                $('select#car_id').trigger('change');
            });

            $(document).on("click", "button.add-extra", function(e) {
                if($('#car_type_id').val()==''){
                    return;
                }
                processing();
                var formData = $('form#car_reservation').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                $.get('/api/load_extras', { car_type_id: $('#car_type_id').val() })
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

                    $('div.lbl-total-price').html(currencySign+' '+prices.total_price)
                    $('div.payment-due').html(currencySign+' '+ (prices.total_price-$('#payment_made').val()))

                    $("table.payment_detail> tbody tr:nth-child(2)").find('th').html('Price per day:<br/><small>'+prices.price_per_day_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(2)").find('td').html(currencySign+' '+prices.price_per_day);


                    $("table.payment_detail> tbody tr:nth-child(4)").find('th').html('Price per hour:<br/><small>'+prices.price_per_hour_detail+'<small>');
                    $("table.payment_detail> tbody tr:nth-child(4)").find('td').html(currencySign+' '+prices.price_per_hour);


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

            $('#pickup_date').datetimepicker({format:'m/d/Y H:i', defaultDate:new Date()});
            $('#date_from').datetimepicker({format:'m/d/Y H:i', defaultDate:new Date(),
                onChangeDateTime:function(dp,$input){
                    calculatePrices();
                }
            });
            $('#date_to').datetimepicker({
                format:'m/d/Y H:i', defaultDate:new Date(),
                onChangeDateTime:function(dp,$input){
//                    $("table.payment_detail> tbody tr:first").find('td').html(
//                        moment($('#date_to').val(), "MM-DD-YYYY HH:mm").diff(moment($('#date_from').val(), "MM-DD-YYYY HH:mm"),'days')
//                        + ' Days and '+moment($('#date_to').val(), "MM-DD-YYYY HH:mm").diff(moment($('#date_from').val(), "MM-DD-YYYY HH:mm"),'hours')+' Hours'
//                    );
                    calculatePrices();
                }
            });

            $('#return_date').datetimepicker({
                format:'m/d/Y H:i', defaultDate:new Date(),
                onChangeDateTime:function(dp,$input){
                    var hours = moment($('#return_date').val(), "MM-DD-YYYY HH:mm").diff(moment($('#date_to').val(), "MM-DD-YYYY HH:mm"),'hours');
                    if(hours>0) {
                        $('#extra_hours_usage').val(hours);
                        $('div.extra-hours-usage').html(hours + ' Hours');
                    }else{
                        $('#extra_hours_usage').val(0);
                        $('div.extra-hours-usage').html('No');
                    }
                }
            });
        });
    </script>
@endsection