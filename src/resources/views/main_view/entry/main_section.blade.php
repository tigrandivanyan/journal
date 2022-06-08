@extends('main_view.entry.layouts.layout')
@section('content')

<div class="container">
    @include('general_view.errors.post_errors')   <!-- form data check errors -->
    @include('main_view.entry.partials.create_new_entry_form')    <!-- new entry area -->
    @include('main_view.entry.partials.new_entry_btn_and_announcement_list')    <!-- operator alert area -->
</div>

    @include('main_view.entry.partials.entries_list_and_entry_edit_form')  <!-- Entrie list area -->
    @include('main_view.entry.partials.journal_instruction')  <!-- instruction area -->

@endsection