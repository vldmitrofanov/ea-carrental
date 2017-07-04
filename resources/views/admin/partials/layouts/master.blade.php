<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @yield('meta-info')
        <title>@yield('title') | Admin Panel</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="{{ asset('administration/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        
        <link rel="stylesheet" href="{{ asset('administration/dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('administration/plugins/iCheck/flat/blue.css') }}">
        <link rel="stylesheet" href="{{ asset('administration/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
        <link rel="stylesheet" href="{{ asset('administration/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('administration/plugins/tooltip/protip.min.css') }}">
        <link rel="stylesheet" href="{{ asset('administration/plugins/datepicker/datepicker3.css') }}">
        <link rel="stylesheet" href="{{ asset('administration/plugins/timepicker/bootstrap-timepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('administration/plugins/datetimepicker/jquery.datetimepicker.css') }}">

        @yield('stylesheet')
        <link rel="stylesheet" href="{{ asset('administration/dist/css/AdminLTE.min.css') }}">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('admin.partials.layouts.header')
            @include('admin.partials.layouts.sidebarmenu')
            
            @yield('content')
            
            @include('admin.partials.layouts.footer')
            @include('admin.partials.layouts.controlsidebar')
            
            <div class="control-sidebar-bg"></div>
        </div>    
    
    
    <script src="{{ asset('administration/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('administration/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('administration/plugins/notify/bootstrap-notify.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

    <script src="{{ asset('administration/plugins/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ asset('administration/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('administration/plugins/jQueryBlock/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('administration/plugins/tooltip/protip.min.js') }}"></script>
    <script src="{{ asset('administration/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('administration/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('administration/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('administration/dist/js/app.min.js') }}"></script>
    @yield('javascript')

    <script type="text/javascript">
        $(document).ready(function(){
            $('ul.sidebar-menu li.active').parents('li.treeview').addClass('active');
        });

//    $("ul.treeview-menu li").each(function (index, object) {
//        if($(this).attr("data-breadcrumb")){
//            breadcrumbs = $(this).attr("data-breadcrumb").toString();
//            var that = this;
//            $(breadcrumbs.split(",")).each(function (index, breadcrumb) {
//                if($(location).attr('href')== breadcrumb ) {
//                    $(that).addClass("active");
//                    $(that).parents('li.treeview').addClass("active");
//                    return false;
//                } else {
//                    $(that).removeClass("active")
//                }
//            })
//        }
//    })
    </script>


    </body>
</html>