<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AlphaMedia journal</title>

        <meta http-equiv="refresh" content="7200" >
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

<style>
    body > .container{
        margin-top:20px;
    }

    body form{
       padding:10px;
    }
    .first-entry-instruction{
        margin-left:10px;
    }
    #dialogTop{
        display:none;
    }
</style>
    </head>
    <body>
        @yield('content')   <!-- main content area -->
    </body>

    <script src="{{asset('/js/js.js')}}" type="text/javascript" ></script> <!--  jQuery -->
    <script src="{{asset('/js/jquery-ui.js')}}"  type="text/javascript"></script>
</html>