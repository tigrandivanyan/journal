<!doctype html>
<html lang="en-US">
<head>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Event Journal</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    {{--<link href="/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="/bootstrap_three/css/bootstrap.css" rel="stylesheet" type="text/css" />--}}

    <!-- THEME CSS -->
    <link href="/admin/css/essentials.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="/admin/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />

    <link href="/admin_panel/css/master.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/font_awesome/js/all.js"></script>

        @yield('cssSection')



</head>
<body>

    <div class="container-fluid"> <!-- WRAPPER -->

        <div class="row">
            @include('admin_panel_view.layout.partials.header')    <!-- HEADER -->
        </div>


        <div class="row">
            <div class="col-3 aside-menu-background">
                @include('admin_panel_view.layout.partials.aside')   <!--  ASIDE  -->
            </div>
            <div class="col-sm">
                <section>  <!-- main content area -->

                    @yield('content')

                </section>   <!-- /main content area -->
            </div>

        </div>






    </div>   <!-- /WRAPPER -->


    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('/bootstrap_four/js/bootstrap.bundle.js')}}"></script>
{{--    <script type="text/javascript" src="{{asset('/bootstrap_three/js/bootstrap.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('/assets/js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin_panel/js/layout/activeMenuItemScript.js')}}" ></script>

    <script type="text/javascript">var plugin_path = '/admin/plugins/';</script>
    <script type="text/javascript" src="/admin/js/app.js"></script>
    <script type="text/javascript" src="/admin/plugins/form.masked/jquery.maskedinput.js"></script>





</body>
</html>