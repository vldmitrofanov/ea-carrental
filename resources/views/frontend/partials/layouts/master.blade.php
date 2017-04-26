<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta-info')
        <title>@yield('title')</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/fixtures.css') }}">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        @include('frontend.partials.layouts.header')
        @yield('content')
        @include('frontend.partials.layouts.footer')

        <script src="{{ asset('template/js/jquery-2.2.3.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('administration/plugins/notify/bootstrap-notify.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="{{ asset('template/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('administration/plugins/jQueryBlock/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('template/js/main.js') }}"></script>

        <script type="text/javascript">
            $(function () {
                $('#start').datetimepicker({
                    useCurrent: false //Important! See issue #1075
                });
                $('#end').datetimepicker({
                    useCurrent: false //Important! See issue #1075
                });
                $("#start").on("dp.change", function (e) {
                    $('#end').data("DateTimePicker").minDate(e.date);
                });
                $("#end").on("dp.change", function (e) {
                    $('#start').data("DateTimePicker").maxDate(e.date);
                });

            });
            $(function () {

            });
            $(window).on('scroll', function () {
                scrollPosition = $(this).scrollTop();
                if (scrollPosition < 85) {
                    $(".bannerCarSearch").removeClass("fixedSearch");
                };
                if (scrollPosition >= 85) {
                    $(".bannerCarSearch").addClass("fixedSearch");
                };
            });
            $('.moreDetail').click(function(){
                $(".showLess").toggle();
                if ($('.moreDetail span').html() == 'More Details') {
                    $('.moreDetail span').html('Less Details');
                }
                else {
                    $('.moreDetail span').html('More Details');
                }
                $('.moreDetail i').toggleClass('fa-angle-down fa-angle-up')
            });
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        @yield('javascript')

    </body>
</html>