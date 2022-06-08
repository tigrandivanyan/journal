<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AlphaMedia journal</title>

        <meta http-equiv="refresh" content="7200" >
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('main_view.entry.layouts.assets.styles')    <!-- Styles -->

    </head>
    <body>

        @include('main_view.entry.layouts.partials.header')    <!-- header area -->

        @include('main_view.entry.layouts.partials.announcement_for_operators')   <!-- notification area -->

        @include('main_view.entry.layouts.partials.tech_support_messages')   <!-- technical support messages -->

        @include('main_view.entry.layouts.partials.chat')   <!-- live chat area -->

        @include('main_view.entry.layouts.partials.replace_operator')   <!-- operator replacement part -->

                @yield('content')   <!-- main content area -->

        @include('main_view.entry.layouts.assets.scripts')   <!-- Scrypts-->

    </body>
</html>