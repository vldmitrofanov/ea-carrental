@extends('admin.partials.layouts.master')
@section('title')
    Office Locations Management | Add New
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Office Locations
                <small>Create New</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        @include('admin.partials.errors.errors')
                        {!! Form::open(array('url' => 'admin/locations/store', 'id'=>'office_location', 'method' => 'post', 'enctype'=>'multipart/form-data')) !!}
                        @include('admin.office_locations.forms.add', ['submit_button'=>'Create'])
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
<?php /*<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdNE4Za2VxMoHty4tYy7QV0drhJkzGZIo" type="text/javascript"></script> */ ?>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDdNE4Za2VxMoHty4tYy7QV0drhJkzGZIo&sensor=false"></script>
<script type="text/javascript" >
$(document).on("click", "button.btn-map", function(e) {
    var formData = $('form#office_location').serializeArray();
    formData.push({
        name: "_method",
        value: "POST"
    });
    $.post('/admin/locations/find_location', formData)
    .done(function(response){
        $('#lat').val(response.data.lat);
        $('#lng').val(response.data.lng);
        initGMap(parseFloat(response.data.lat), parseFloat(response.data.lng), $('#name').val());
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
function initGMap(lat, lng, title){
        var latlng = new google.maps.LatLng(lat, lng);
        var mapOptions = {
                          center: latlng,
                          zoom: 14,
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
        var map = new google.maps.Map(document.getElementById("world-map"), mapOptions);
        var marker = new google.maps.Marker({
                                                draggable: true,
                                                position: latlng,
                                                map: map,
                                                title: title
                                        });
        google.maps.event.addListener(marker, 'dragend', function (event) {
            $('#lat').val(this.getPosition().lat());
            $('#lng').val(this.getPosition().lng());
        });
}
</script>
@endsection    