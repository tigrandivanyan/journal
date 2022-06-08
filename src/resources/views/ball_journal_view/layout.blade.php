<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AlphaMedia ball journal</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('ball_journal_view.assets.styles')    <!-- Assets -->

    </head>
    <body>

        <main class="container">
            @include('ball_journal_view.partials.navbar')
            @include('general_view.errors.post_errors')
            @include('ball_journal_view.partials.new_entry_btn_and_announcements')
            @include('ball_journal_view.partials.modal_with_event_types')
            @include('ball_journal_view.partials.form_views_for_adding_new_entry')
            @include('ball_journal_view.partials.form_views_for_editing_entry')
        </main>

            @include('ball_journal_view.partials.table_entry_filtering_area')
            @include('ball_journal_view.partials.entry_table')

            @include('ball_journal_view.assets.scripts')   <!-- Scrypts-->

    </body>
</html>