@extends('admin.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Office Locations Management | Update Info
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Office Location
                <small>Update Info</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                        @include('admin.partials.errors.errors')
                        {!! Form::model($oOfficeLocation, array('url' =>array('admin/locations/update', $oOfficeLocation->id), 'id' => 'office_location', 'method' => 'PATCH', 'enctype'=>'multipart/form-data', 'class' => "form-horizontal")) !!}
                        {{ Form::hidden('location',$oOfficeLocation->id ) }}
                        @include('admin.office_locations.forms.edit', ['submit_button'=>'Create'])
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" >
        $( document ).ready(function() {
            $(".timepicker").timepicker({
                showInputs: false
            });

            //Date picker
            $('#work_date').datepicker({
                autoclose: true
            });

            $(document).on("click", "button.btn-custom-time", function(e) {
                if($('#work_date').val()==''){
                    displayMessageAlert('Please select Date first.', 'error', 'exclamation-sign');
                    return false;
                }else if($('#start_time').val()==''){
                    displayMessageAlert('Please select Start Time first.', 'error', 'exclamation-sign');
                    return false;
                }else if($('#end_time').val()==''){
                    displayMessageAlert('Please select End Time first.', 'error', 'exclamation-sign');
                    return false;
                }

                processing();
                var formData = $('form#office_location').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                $.post('/admin/locations/location_customtime', formData)
                .done(function(response){
                    $('#custom_time').val('');
                    $("table.custom_time").find('tbody')
                            .append($('<tr id="'+(response.data.time.id)+'">')
                                    .append($('<td>')
                                            .append(response.data.time.work_date)
                                    )
                                    .append($('<td>')
                                            .append(response.data.time.start_time)
                                    )
                                    .append($('<td>')
                                            .append(response.data.time.end_time)
                                    )
                                    .append($('<td>')
                                            .append((response.data.time.is_dayoff?'Yes':'No'))
                                    )
                                    .append($('<td>')
                                            .append('<a href="javascript:;" class="edit-ctime" data-id="'+(response.data.time.id)+'" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a href="javascript:;" class="remove-ctime" data-id="'+(response.data.time.id)+'" ><i class="fa fa-trash"></i></a>')
                                    )
                            );
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

            });

            $(document).on("click", "a.remove-ctime", function(e) {
                processing();
                var cTimeId = $(this).attr('data-id');
                var formData = $('form#office_location').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                formData.push({
                    name: "ctime_id",
                    value: cTimeId
                });
                $.post('/admin/locations/remove_customtime', formData)
                        .done(function(response){
                            $('table.custom_time > tbody tr#'+cTimeId).remove()
                            $.unblockUI();
                            displayMessageAlert(response.message);
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

            $(document).on("click", "a.edit-ctime", function(e) {
                processing();
                var cTimeId = $(this).attr('data-id');
                var formData = $('form#office_location').serializeArray();
                formData.push({
                    name: "_method",
                    value: "POST"
                });
                formData.push({
                    name: "ctime_id",
                    value: cTimeId
                });
                $.post('/admin/locations/load_customtime', formData)
                        .done(function(response){
                            $('table.custom_time > tbody tr#'+response.data.time.id).remove()

                            $('#work_date').val(response.data.time.work_date)
                            $('#start_time').val(response.data.time.start_time)
                            $('#end_time').val(response.data.time.end_time)
                            if(response.data.time.is_dayoff==1){
                                $('#is_dayoff').prop('checked', true);
                            }else{
                                $('#is_dayoff').prop('checked', false);
                            }
                            $('#custom_time').val(response.data.time.id);
                            $.unblockUI();
                        })
                        .fail(function(response){
                            $('#custom_time').val();
                            $.unblockUI();
                            $.each(response.responseJSON, function (key, value) {
                                $.each(value, function (index, message) {
                                    displayMessageAlert(message, 'danger', 'warning-sign');
                                });
                            });
                        });

                $('table.extra_rates tr#'+$(this).attr('data-id')).remove();
            })

        });
    </script>
@endsection