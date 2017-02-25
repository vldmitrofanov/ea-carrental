@extends('admin.partials.layouts.master')
@section('title')
    Car Types Management | Add New
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Types
                <small>Create New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        @include('admin.partials.errors.errors')
                        {!! Form::open(array('url' => 'admin/types/store', 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
                        <div class="alert alert-info alert-dismissible">
                            <h4><i class="icon fa fa-info"></i> Add new car type!</h4>
                            Fill in the form below to add a new car type. Please, note that your clients view and book car types not a specific vehicle/car, so it's very important to fill in the specification details carefully. Using the 'Available extras' drop down field you can choose which extras are available with the car type and can be selected by clients when making a reservation. If you have multiple language versions of your car rental system do not forget to fill in the car type title and description in all languages that you use.
                        </div>
                        @include('admin.car_types.types.forms.add', ['submit_button'=>'Create'])
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" >
        $( "#country" ).change(function(){
            $.get("{{ url('api/getstatelist')}}",
                    { option: $(this).val() },
                    function(data) { console.log(data);
                        $('#state').empty();
                        $('#city').empty();
                        $.each(data, function(key, element) {
                            $('#state').append("<option value='" + key +"'>" + element + "</option>");
                        });
                    });

        });
        $( "#state" ).change(function(){
            $.get("{{ url('api/getcitylist')}}",
                    { option: $(this).val() },
                    function(data) { console.log(data);
                        $('#city').empty();
                        $.each(data, function(key, element) {
                            $('#city').append("<option value='" + key +"'>" + element + "</option>");
                        });
                    });

        });
    </script>
@endsection