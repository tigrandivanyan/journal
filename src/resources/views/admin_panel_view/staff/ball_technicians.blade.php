@extends('admin_panel_view.layout.master')
@section('content')

    <div id="app">

        <div>
            <header id="page-header">
                <h1>Техники по шарам</h1>         <!-- page title -->
            </header>
            <modal-notification></modal-notification>
            <ball-technician-restore-list></ball-technician-restore-list>
            <ball-technician-edit-form></ball-technician-edit-form>
            <ball-technician-add-form></ball-technician-add-form>
            <ball-technician-list></ball-technician-list>
        </div>
    </div>


    <script type="text/javascript" src="/assets/js/app.js"></script>

@endsection



