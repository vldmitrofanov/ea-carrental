@extends('admin.partials.layouts.master')
@section('title')
Country Management | Update Info
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Countries Management
            <small>Edit Info</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    @include('admin.partials.errors.errors')
                    <div class="alert alert-info alert-dismissible">
                        <h4><i class="icon fa fa-info"></i> Update extra!</h4>
                        Change extra name, set its price and click on Save button.
                    </div>
                    {!! Form::model($oCarExtra, array('url' =>array('admin/extras/update', $oCarExtra->id), 'method' => 'PATCH', 'enctype'=>'multipart/form-data')) !!}
                     @include('admin.car_types.extras.form', ['submit_button'=>'Save'])
                        
                </div>
            </div>
        </div> 
    </section>
</div>
@endsection
