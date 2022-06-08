@extends('admin_panel_view.layout.master')
@section('content')

    <div id="app">

        <div>
            <header id="page-header">
                <h1>Админы</h1>         <!-- page title -->
            </header>
            <modal-notification></modal-notification>
            <modal-notification-on-administrator-role-retract></modal-notification-on-administrator-role-retract>
            <administrator-add-form></administrator-add-form>
            <administrator-list></administrator-list>
        </div>
    </div>


    <script type="text/javascript" src="/assets/js/app.js"></script>

@endsection



