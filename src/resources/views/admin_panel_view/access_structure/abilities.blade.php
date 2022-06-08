@extends('admin_panel_view.layout.master')
@section('content')

    <div id="app">
        <div>
            <header id="page-header">
                <h1>Права</h1>         <!-- page title -->
            </header>
            <modal-notification></modal-notification>
            <abilities></abilities>
        </div>
    </div>

    <script type="text/javascript" src="/assets/js/app.js"></script>

@endsection
