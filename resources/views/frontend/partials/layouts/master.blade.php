<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta-info')
        <title>@yield('title')</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('template/css/jquery.datetimepicker.css') }}" />
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
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-102528545-1', 'auto');
            ga('send', 'pageview');

        </script>
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
                    minDate: 0,
                    onShow:function( ct ){
                        this.setOptions({
                            maxDate:$('#end').val()?$('#end').val():false
                        })
                    },
                    useCurrent: false //Important! See issue #1075
                });
                $('#end').datetimepicker({
                    minDate:0,
                    onShow:function( ct ) {
                        this.setOptions({
                            minDate: $('#start').val() ? $('#start').val() : false
                        })
                    },
                    useCurrent: false //Important! See issue #1075
                });
//                $("#start").on("dp.change", function (e) {
//                    $('#end').data("DateTimePicker").minDate(e.date);
//                });
//                $("#end").on("dp.change", function (e) {
//                    $('#start').data("DateTimePicker").maxDate(e.date);
//                });

            });

            $(window).on('scroll', function () {
                scrollPosition = $(this).scrollTop();
                if (scrollPosition < 670) {
                    $(".bannerCarSearch").removeClass("fixedSearch");
                };
                if (scrollPosition >= 670) {
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