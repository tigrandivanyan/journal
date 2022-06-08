@extends('admin_panel_view.layout.master')
@section('content')

    <div id="app">

        <div>
            <header id="page-header">
                <h1>Дежурные</h1>         <!-- page title -->
            </header>
            <modal-notification></modal-notification>
            <chef-restore-list></chef-restore-list>
            <chef-edit-form></chef-edit-form>
            <chef-add-form></chef-add-form>
            <chef-list></chef-list>
        </div>
    </div>


    <script type="text/javascript" src="/assets/js/app.js"></script>

@endsection



