@extends('admin.partials.layouts.master')
@section('title')
    Car Inventory Management | Update Information
@endsection
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Inventory
                <small>Update Information</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        @include('admin.partials.errors.errors')
                        {!! Form::model($oRentalCar, array('url' =>array('admin/fleet/cars/update', $oRentalCar->id), 'id' => 'rental_cars', 'method' => 'PATCH', 'enctype'=>'multipart/form-data')) !!}
                        <input type="hidden" name="make" id="make" value="{{ $oRentalCar->model_id }}">
                        <input type="hidden" name="car" id="car" value="{{ $oRentalCar->id }}">
                        @include('admin.fleet_management.cars.form', ['submit_button'=>'Submit'])
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection


@section('javascript')
    <script type="text/javascript" >
        $(document).ready(function(){
            $('#type_id').trigger('change');

            $(document).on("click", "button.btn-save", function(e) {
                processing();
//                var formData = $('form#rental_cars').serializeArray();
                var formData = new FormData($('form#rental_cars')[0]);
                formData.append("_method", "PATCH");
//                $.post($('form#rental_cars').attr('action'), formData)
                $.ajax({
                    url: $('form#rental_cars').attr('action'),
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .done(function(response){
                    displayMessageAlert(response.message);
                    redirectPage('/admin/fleet/cars')
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
        $(document).on("change", "select#type_id", function(e) {
            $('#model_id').empty();
            $('#model_id').append("<option value=''>Select Make & Model</option>");

            processing();
            $.get('/api/load_car_models_list', { car_type_id: $(this).val() })
            .done(function(response){
                var cars = response.data.cars;
                $.each(cars, function(key, element) {
                    $('#model_id').append("<option value='" + element.id +"'>" + element.make +' - '+element.model+ "</option>");
                });
                $('#model_id option[value='+$('#make').val()+']').attr('selected','selected');
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

    </script>
@endsection