@extends('admin.partials.layouts.master')
@section('title')
    Freebies Discounts Management | Add New
@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('administration/plugins/select2/select2.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Freebies Discounts
                <small>Create New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.partials.errors.errors')
                    {!! Form::open(array('url' => 'admin/discounts/freebies/store', 'id'=>'vouchers', 'method' => 'post', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal')) !!}
                    @include('admin.discounts.freebies.forms.add', ['submit_button'=>'Create'])
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
<script type="text/javascript" >
    $(document).ready(function(){
        var items = new Array();
        @foreach($oTypes as $oType)
                items['{{$oType->id}}'] = '{{ ($oType->vehicleSize)?$oType->vehicleSize->code_letter:'-'  }}{{ ($oType->vehicleDoors)?$oType->vehicleDoors->code_letter:'-'  }}{{ ($oType->vehicleTransmissionAndDrive)?$oType->vehicleTransmissionAndDrive->code_letter:'-'  }}{{ ($oType->vehicleFuelAndAC)?$oType->vehicleFuelAndAC->code_letter:'-'  }}';
        @endforeach

        $('#start_date_0').datetimepicker({format:'m/d/Y', defaultDate:new Date(),timepicker:false,});
        $('#end_date_0').datetimepicker({format:'m/d/Y', defaultDate:new Date(),timepicker:false,});

        $(document).on("click", "button.save-voucher", function(e) {
            var models= $('.models');
            var error = 0;
            for (var i = 0; i < models.length; i++) {
                if($(models[i]).val()==''){
                    $(models[i]).closest('div.form-group').addClass('has-error');
                    error++;
                }else{
                    $(models[i]).closest('div.form-group').removeClass('has-error');
                }
            }
            if(error>0){
                displayMessageAlert('Please enter the missing fields', 'danger', 'warning-sign');
                return false;
            }

            var formData = $('form#vouchers').serializeArray();
            formData.push({
                name: "_method",
                value: "POST"
            });
            $.post($('form#vouchers').attr('action'), formData)
                    .done(function(response){
                        displayMessageAlert(response.message);
                        redirectPage('/admin/discounts/freebies')
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

        $(document).on("click", "button.btn-addtype", function(e) {
            var id = $.now();

            $("table.products-table").find('tbody')
                    .append($('<tr id="'+id+'">')
                            .append($('<td>')
                                    .append($('<div>')
                                            .attr('class', 'form-group')
                                            .append($('<div>')
                                                    .attr('class', 'col-sm-4 col-sm-offset-2')
                                                    .append($('<select>')
                                                            .attr('class', 'form-control')
                                                            .attr('name', 'types['+id+']')
                                                            .attr('id', 'types_'+id+'')
                                                            .attr('data-index', id)
                                                            .attr('onchange', 'loadModels(this)')
                                                            .append($("<option></option>")
                                                                    .attr("value",'')
                                                                    .text('Type')
                                                            )
                                                    )
                                            )
                                            .append($('<div>')
                                                    .attr('class', 'col-sm-4')
                                                    .append($('<select>')
                                                            .attr('class', 'form-control models')
                                                            .attr('name', 'models['+id+']')
                                                            .attr('id', 'models_'+id+'')
                                                            .attr('data-index', id)
                                                            .append($("<option></option>")
                                                                    .attr("value", '')
                                                                    .text('Make & Model')
                                                            )
                                                    )
                                            )
                                            .append($('<div>')
                                                    .attr('class', 'col-sm-2')
                                                    .append('<a href="javascript:;" class="remove-type"  data-id="'+id+'"><i class="fa fa-trash" style="padding-top: 8px;"></i></a>')
                                            )
                                    )
                            )
                    );
//            add options
            $.each(items, function(key, element) {
                if(typeof element != 'undefined')
                    $('#types_'+id).append("<option value="+ key+">" + element + "</option>");
            });

        });

        $(document).on("click", "a.remove-type", function(e) {
            $('table.products-table tr#'+$(this).attr('data-id')).remove();
        })

        $(document).on("click", "a.remove-period", function(e) {
            $('table.periods-table tr#'+$(this).attr('data-id')).remove();
        })

        $(document).on("click", "button.btn-addperiod", function(e) {
            var id = $.now();

            $("table.periods-table").find('tbody')
                    .append($('<tr id="'+id+'">')
                            .append($('<td>')
                            )
                    );
//            add options
            periodHtml = '<div class="form-group">'+
                    '<div class="col-sm-4 col-sm-offset-2">'+
                    '<div class="input-group">'+
                    '<div class="input-group-addon">'+
                    '<i class="fa fa-clock-o"></i></div>'+
                    '<input class="form-control" id="start_date_'+id+'"  placeholder="Date From" name="start_date[]" type="text">'+
                    '</div>&nbsp</div>'+

                    '<div class="col-sm-4"><div class="input-group">'+
                    '<div class="input-group-addon">'+
                    '<i class="fa fa-clock-o"></i>'+
                    '</div>'+
                    '<input class="form-control" id="end_date_'+id+'" placeholder="End From" name="end_date[]" type="text">'+
                    '</div>&nbsp</div>'+

                    '<div class="col-sm-2"><a href="javascript:;" class="remove-period"  data-id="'+id+'"><i class="fa fa-trash" style="padding-top: 8px;"></i></a></div>'+
                    '</div>';
            $('table.periods-table tr#'+id).html(periodHtml);
            datesAttach(id);
        });

    });

    function datesAttach(id){
        $('#start_date_'+id).datetimepicker({format:'m/d/Y', defaultDate:new Date(),timepicker:false,});
        $('#end_date_'+id).datetimepicker({format:'m/d/Y', defaultDate:new Date(),timepicker:false,});
    }
    function loadModels(obj){
        var indexVal = $(obj).attr('data-index');
        $('#models_'+indexVal).empty();
        $('#models_'+indexVal).append("<option>Select Make & Model</option>");
        if($(obj).val()==''){
            return;
        }
        processing();
        $.get('/api/load_car_models_list', { car_type_id: $(obj).val() })
                .done(function(response){
                    var cars = response.data.cars;
                    $.each(cars, function(key, element) {
                        $('#models_'+indexVal).append("<option value='" + element.id +"'>" + element.make +' - '+element.model+ "</option>");
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
    }
    
</script>
@endsection