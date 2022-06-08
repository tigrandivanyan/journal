@extends('admin_panel_view.layout.master')
@section('content')

    <div id="app">
        <div>
            <header id="page-header">
                <h1>Назначенные Роли</h1>         <!-- page title -->
            </header>
            <modal-notification></modal-notification>
            <add-assigned-role></add-assigned-role>
            <assigned-roles></assigned-roles>
        </div>
    </div>

    <script type="text/javascript" src="/assets/js/app.js"></script>

@endsection
