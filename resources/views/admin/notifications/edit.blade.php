@extends('admin.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Email Notifications Management | Update Info
@endsection

@section('stylesheet')
<style>
    .modal .modal-body {
        max-height: 420px;
        overflow-y: auto;
    }
</style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Email Notifications
                <small>Update Info</small>
            </h1>
            <ol class="breadcrumb">
                <li><button class="btn btn-info btn-tags"><i class="fa fa-tags"></i> Email Tags</button></li>
            </ol>
            
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.partials.errors.errors')
                    {!! Form::model($oEmailNotification, array('url' =>array('admin/notifications/update', $oEmailNotification->id), 'id' => 'notification', 'method' => 'PATCH', 'enctype'=>'multipart/form-data', 'class' => "form-horizontal")) !!}
                    @include('admin.notifications.form', ['submit_button'=>'Save'])
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>

<div id="tagsModal" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button">
          <span aria-hidden="true">×</span></button><h4 class="modal-title">Tags</h4>
      </div>
      <div class="modal-body">
          <table class="table table-bordered tags-tbl">
              <tbody></tbody>
          </table>
      </div>
      
    </div>
  </div>
</div>

@endsection

@section('javascript')
    <script type="text/javascript" >
        $(document).on("click", "a.insert-tag", function(e) {
            var text = $(this).attr('data-tag');
            if (document.selection) {
                    $('#email_body').focus();
                    sel = document.selection.createRange();
                    sel.text = text;
            } else if (document.getElementById('email_body').selectionStart || document.getElementById('email_body').selectionStart == '0') {
                    var startPos = document.getElementById('email_body').selectionStart;
                    var endPos = document.getElementById('email_body').selectionEnd;
                    document.getElementById('email_body').value = document.getElementById('email_body').value.substring(0, startPos)
                            + text
                            + document.getElementById('email_body').value.substring(endPos, document.getElementById('email_body').value.length);
            } else {
                    document.getElementById('email_body').value += text;
            }
        });
        
        $(document).on("click", "button.btn-tags", function(e) {
            processing();
            $("table.tags-tbl").find('tbody').empty();
            $.get('/api/email_tags')
            .done(function(response){
                $.each(response.tags, function (key, value) {
                    $("table.tags-tbl").find('tbody')
                    .append($('<tr>')
                            .append($('<td>')
                                .append('<a class="text-light-blue">'+value+'</a>')
                            )
                            .append($('<td>')
                                .append('<a href="javascript:;" class="insert-tag" data-tag="'+key+'"><span class="badge bg-green">Insert Tag</span></a>')
                            )
                    );
                });
                $.unblockUI();
                $('#tagsModal').modal({show: true});
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
    </script>
@endsection