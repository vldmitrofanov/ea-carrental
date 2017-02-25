@extends('admin.partials.layouts.master')
@section('title')
    Users Management | Add New
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Users
                <small>Create New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        @include('admin.partials.errors.errors')
                        {!! Form::model($oUser, array('url' =>array('admin/users/update', $oUser->id), 'id' => 'user_form', 'autocomplete' => "off", 'method' => 'PATCH', 'enctype'=>'multipart/form-data')) !!}
                        {{ Form::hidden('user',$oUser->id ) }}
                        @include('admin.users.form', ['submit_button'=>'Create'])
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection