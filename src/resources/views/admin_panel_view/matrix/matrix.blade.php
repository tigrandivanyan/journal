@extends('admin_panel_view.layout.master')
@section('content')

    <header id="page-header">
        <h1>Конфигурации Matrix</h1>         <!-- page title -->
    </header>
    <div id="content" class="padding-20"> <!-- all content wrapepr-->
        <div id="panel-5" class="panel panel-default">  <!--  all content div-->
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>Все комнаты для рассылки</strong> <!-- panel title -->
                </span>
            </div>
            <div class="panel-body">  <!-- panel content -->
                <div class="table-responsive">
                    <table class="table table-sm table-striped mt-4">  <!-- all users list-->
                        <thead>
                        <tr>
                            <th>__ID__</th>
                            <th>Назначение</th>
                            <th>ID активной комнаты </th>
                            <th>Название активной комнаты </th>
                            <th>Пользователь</th>
                            <th>Показать все комнаты</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($matrixUsers as $entry)
                            <tr class="<?php if ($entry->active == 0) echo 'unactive-matrix-room'; ?>">
                                <td class="entry-id" data-entry-id="{{$entry->id}}">{{$entry->id}}</td>
                                <td class="entry-purpose" data-entry-id="{{$entry->id}}">{{$entry->purpose}}</td>
                                <td class="entry-room-id" data-entry-id="{{$entry->id}}">{{$entry->room_id}}</td>
                                <td class="entry-room-name" data-entry-id="{{$entry->id}}">{{$entry->room_name}}</td>
                                <td class="entry-username" data-entry-id="{{$entry->id}}">{{$entry->username}}</td>
                                <td>   <!-- show all rooms button-->
                                    <a class="btn btn-light btn-outline-secondary btn-sm"
                                       data-entry-id="{{$entry->id}}"
                                       href="javascript:;"
                                       onclick="toggleLoginForm(this);">
                                        <i class="fa fa-edit white"></i>
                                        Показать
                                    </a>
                                </td>
                                <td>   <!-- delete room button-->
                                    <a class="btn btn-light btn-outline-secondary btn-sm"
                                       data-entry-id="{{$entry->id}}"
                                       href="javascript:;"
                                       onclick="deleteEntry(this);">
                                        <i class="fa fa-edit white"></i>
                                        Удалить
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>     <!-- /panel content -->


            @if(count($errors))
                <div class="form-group">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
        @endif
        <!-- panel hided content -->
            <div class="panel-footer">
                <!-- toggle form for adding new matrix user -->
                <div class="text-left">
                    <a class="btn btn-xs btn-info mt-4" href="javascript:;" onclick="dislayAddNewUserForm();">Добавить нового пользователя</a>
                </div>

                <!-- user login form wrapper -->
                <div id="login-form-wrapper" class="text-left noradius text-danger softhide mt-4">

                    <form action="{{route('admin-panel.matrix.login')}}" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        {{ csrf_field() }}
                        <fieldset>

                            <input type="hidden" name="purpose" id="purpose" value="">
                            <input type="hidden" name="entry_id" id="entry_id" value="">

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Логин</label>
                                <input id="username" name="username" class="form-control col-md col-sm">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Пароль</label>
                                <input name="password" class="form-control col-md col-sm">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3" for="not_active">Сделать комнату НЕ активной</label>
                                <input type="checkbox" id="not_active" name="not_active" class="form-control col-md col-sm">
                            </div>


                            <div class="row form-group">
                                <div class="col-md-3 col-sm-3"></div>
                                <div class="col-md col-sm">
                                    <button class="btn btn-light btn-outline-secondary"><i class="fa fa-save white"></i>Войти</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>

                <!-- create new matrix user form wrapper-->
                <div id="newUserFormWrapper" class="text-left noradius text-danger softhide mt-4">

                    <form action="{{route('admin-panel.matrix.signin')}}" method="post">
                        {{ csrf_field() }}
                        <fieldset>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Имя пользователя</label>
                                <input id="eng_name" name="username" value="" class="form-control col-md col-sm">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Пароль</label>
                                <input id="ru_name" name="password" value="" class="form-control col-md col-sm">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Назначение</label>
                                <input name="purpose" value="" class="form-control col-md col-sm">
                            </div>

                            <div class="row form-group">
                                <div class="col-md-3 col-sm-3"></div>
                                <div class="col-md col-sm">
                                    <button class="btn btn-light btn-outline-secondary"><i class="fa fa-save white"></i> Сохранить </button>
                                </div>
                            </div>

                        </fieldset>
                    </form>

                    <form id="delete-entry" action="{{route('admin-panel.matrix.delete')}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <input type="hidden" id="room_record_id" name="room_record_id">
                    </form>
                </div>     <!-- / create new matrix user form wrapper -->
            </div>
            <br>

            <div class="alert alert-success" role="alert">
                Комната для сообщений в тех. поддержку должна быть с назначением 'support' !
            </div>

        </div>    <!--  all content div-->
    </div>    <!-- /all content wrapepr-->

    <!-- script section -->
    <script src="{{asset('admin_panel/js/matrix/matrix/master.js')}}"  type="text/javascript"></script>


@endsection



