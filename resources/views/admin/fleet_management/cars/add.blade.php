@extends('admin.partials.layouts.master')
@section('title')
    Rental Cars Management | Add New
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Rental Cars
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
                $('#model_id').append("<option>Select Make & Model</option>");
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
            })
        });
    </script>
@endsection