<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Alpha Media</title>

<!-- Styles and scrypts-->
    @include('main_view.welcome.assets.styles')

    </head>
    <body>

    <!-- Authentication Links -->
    <div  class="flex-center " >
        <div class="container">
            @include('general_view.authentication_links.authentication_links')
        </div>
    </div>


<!-- Main content -->
            <div class="flex-center position-ref full-height" >

            <div class="content">
                <div class="title m-b-md" style="font-family: 'Raleway', sans-serif">
                    Alpha Media
                </div>

                <div class="links">

                    @foreach ($studios as $studio)
                        <a href="{{ route('studio.filter', $studio->name_eng) }}">{{ $studio->name_ru  }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        @include('main_view.welcome.assets.scripts')

    </body>
</html>
