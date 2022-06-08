@extends('admin_panel_view.layout.master')
@section('content')

    <div id="app">

            <header id="page-header">
                <h1>Список всех студий</h1>         <!-- page title -->
            </header>
            <modal-notification></modal-notification>
            <modal-notification-on-studio-delete></modal-notification-on-studio-delete>
            <studio-edit-form></studio-edit-form>
            <studio-add-form></studio-add-form>
            <studio-list></studio-list>
    </div>

@endsection



