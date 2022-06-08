@extends('admin_panel_view.layout.master')
@section('content')

    <div id="app">
        <div>
            <header id="page-header">
                <h1>Роли</h1>         <!-- page title -->
            </header>
            <modal-notification></modal-notification>
            <roles-list></roles-list>
        </div>
    </div>

    <script type="text/javascript" src="/assets/js/app.js"></script>

@endsection
