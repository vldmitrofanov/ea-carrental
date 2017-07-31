@extends('admin.partials.layouts.master')
@section('title')
    Car Inventory Management | Add New
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Inventory
                <small>Create New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        @include('admin.partials.errors.errors')
                        {!! Form::open(array('url' => 'admin/fleet/cars/store', 'id'=>'rental_cars', 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
                        @include('admin.fleet_management.cars.form', ['submit_button'=>'Create'])
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
<script type="text/javascript" >
    $(document).ready(function(){
        $(document).on("change", "select#type_id", function(e) {
            $('#model_id').empty();
            $('#model_id').append("<option value=''>Select Make & Model</option>");
            if($(this).val()==''){
                return;
            }
            processing();
            $.get('/api/load_car_models_list', { car_type_id: $(this).val() })
            .done(function(response){
                var cars = response.data.cars;
                $.each(cars, function(key, element) {
                    $('#model_id').append("<option value='" + element.id +"'>" + element.make +' - '+element.model+ "</option>");
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

        $(document).on("change", "select#model_id", function(e) {
            var makeAndModel = $('#model_id :selected').text();
            var registrationNumber = $('#registration_number').val();
            var token = makeAndModel.replace(/\s+/g, '') +'-'+ registrationNumber.replace(/\s+/g, '');
            $('#url_token').val(token.toLowerCase());
        });

        $('#registration_number').on("blur", function(e) {
            var makeAndModel = $('#model_id :selected').text();
            var registrationNumber = $('#registration_number').val();
            var token = makeAndModel.replace(/\s+/g, '') +'-'+ registrationNumber.replace(/\s+/g, '');
            $('#url_token').val(token.toLowerCase());
        });

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
</script>
@endsection