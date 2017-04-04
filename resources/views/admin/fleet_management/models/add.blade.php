@extends('admin.partials.layouts.master')
@section('title')
    Car Make & Model Management | Add New
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Car Make & Model Management
                <small>Create New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        @include('admin.partials.errors.errors')
                        {!! Form::open(array('url' => 'admin/fleet/models/store', 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
                        @include('admin.fleet_management.models.forms.add', ['submit_button'=>'Create'])
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
    </script>
@endsection