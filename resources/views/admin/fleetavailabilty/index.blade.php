@extends('admin.partials.layouts.master')

@section('title')
    Fleet Availability
@endsection

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