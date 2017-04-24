@extends('admin.partials.layouts.master')
@section('title')
    Email Notification Settings Management
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Email Notification Settings
                <small>Management</small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                @include('admin.partials.errors.errors')
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Showing {!! $oEmails->currentPage() !!} of {!! $oEmails->lastPage() !!} </h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Notify Subject</th>
                                    <th>Event</th>
                                    <th>&nbsp;</th>
                                </tr>
                                @foreach($oEmails as $index =>$oEmail)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $oEmail->name }}</td>
                                        <td>{{ config('settings.email_notification_types')[$oEmail->notify_event] }}</td>
                                        <td><a href="{{ url('admin/notifications/'.$oEmail->id.'/edit') }}"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @if($oEmails->render())
                            <div class="box-footer clearfix">
                                {!! $oEmails->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

