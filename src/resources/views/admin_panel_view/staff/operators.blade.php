@extends('admin_panel_view.layout.master')
@section('content')

    <div id="app">

        <div>
            <header id="page-header">
                <h1>Операторы</h1>         <!-- page title -->
            </header>
            <modal-notification></modal-notification>
            <operator-restore-list></operator-restore-list>
            <operator-edit-form></operator-edit-form>
            <operator-add-form></operator-add-form>
            <operator-list></operator-list>
        </div>
    </div>


    <script type="text/javascript" src="/assets/js/app.js"></script>

@endsection



