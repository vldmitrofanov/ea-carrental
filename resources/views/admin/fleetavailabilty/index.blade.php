@extends('admin.partials.layouts.master')

@section('title')
    Fleet Availability
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Fleet Availability
                <small>FullCalendar API's </small>
            </h1>
        </section>

        <section class="content">

            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="box box-primary">
                        <div id='calendar'></div>

                        <div class="box-body">
                            <?php /*{!! $calendar->calendar() !!}*/?>
                        </div>
                    </div>
                </section>

            </div>

        </section>
    </div>

    <div class="modal modal-default fade" id="modal-success">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="eventTitle">Success Modal</h4>
                </div>
                <div class="modal-body">
                    <strong>Reservation Start</strong>: <span id="startTime"></span><br>
                    <strong>Reservation End</strong>: <span id="endTime"></span><br><br>
                    <strong>Reservation Details</strong>: <p id="eventInfo"></p>
                    <p><strong><a id="eventLink" href="" target="_blank">Check Reservation Detail</a></strong></p>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection

<?php /*
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Fleet Availability
                <small>Google Embeddable Calendar </small>
            </h1>
        </section>

        <section class="content">

        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="box box-primary">

                    <div class="box-body">
                        <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23ffffff&amp;src=koc4n7b6sp3u5dsqs6ss1ksk7s%40group.calendar.google.com&amp;color=%23182C57&amp;ctz=Asia%2FKarachi" style="border-width:0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
                    </div>
                </div>
            </section>

        </div>

        </section>
    </div>

@endsection

*/ ?>


@section('javascript')
    <script src=" //cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href=" //cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css"/>
    <script src="{{ asset('administration/plugins/fullcalendar/scheduler.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('administration/plugins/fullcalendar/scheduler.min.css') }}">

    <script>

        $(function() { // document ready

            $('#calendar').fullCalendar({
                'schedulerLicenseKey': '0064401824-fcs-149251997700',
                now: moment().format("YYYY-MM-DD"),
                editable: false, // enable draggable events
                aspectRatio: 1.8,
                scrollTime: '00:00', // undo default 6am scrollTime
                header: {
                    left: 'today prev,next',
                    center: 'title',
                    right: 'timelineDay,timelineThreeDays,agendaWeek,month,listWeek'
                },
                defaultView: 'timelineDay',
                views: {
                    timelineThreeDays: {
                        type: 'timeline',
                        duration: { days: 3 }
                    }
                },
                resourceLabelText: 'Cars',
                resources: {!! $cars  !!} ,
                events: {!! $reservations  !!}
            });

        });

    </script>
    <?php /*{!! $calendar->script() !!}*/?>
@endsection
