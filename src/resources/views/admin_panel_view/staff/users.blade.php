@extends('admin_panel_view.layout.master')
@section('content')

    <header id="page-header">
        <h1>Пользователи</h1>         <!-- page title -->
    </header>

    <div id="content" class="padding-20">     <!-- all content wrapepr-->
        <div id="panel-5" class="panel panel-default">  <!--  all content div-->

            <div class="panel-heading">
                                <span class="title elipsis">
                                    <strong>Все пользователи</strong>  <!-- panel title -->
                                </span>
                <!-- right options -->
                <ul class="options pull-right list-inline">
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                    <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                </ul>
            </div>
            <div class="panel-body">  <!-- panel content -->
                <div class="table-responsive">
                    <table class="table table-sm table-striped mt-4">
                        <thead>
                        <tr>
                            <th>___ID___</th>
                            <th>Имя</th>
                            <th>Логин</th>
                            <th>ID оператора</th>
                            <th>ID дежурного</th>
                            <th>Данные</th>
                            <th>Пароль</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="user_id">{{$user->id}}</td>
                                <td class="user_name">{{$user->name}}</td>
                                <td class="user_username">{{$user->username}}</td>
                                <td class="user_operator_id">{{$user->operator_id}}</td>
                                <td class="user_chef_id">{{$user->chef_id}}</td>
                                <td>   <!-- edit button-->
                                    <a class="btn btn-light btn-outline-secondary btn-sm"
                                       href="javascript:;"
                                       onclick="editUserFormDisplay(this); ">
                                            <i class="fa fa-edit white"></i>
                                        Изменить
                                    </a>
                                </td>
                                <td>   <!-- edit password button-->
                                    <a class="btn btn-light btn-outline-secondary btn-sm"
                                       href="javascript:;"
                                       onclick="editUserPasswordFormDisplay(this); ">
                                            <i class="fa fa-edit white"></i>
                                        Изменить
                                    </a>
                                </td>
                                <td>  <!-- delete button-->
                                    <a class="btn btn-light btn-outline-secondary btn-sm"
                                       href="javascript:;"
                                       onclick="deleteUserFormSubmit(this); ">
                                        <i class="fa fa-times white"></i>
                                        Удалить
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>     <!-- /panel content -->

        @include('general_view.errors.post_errors')

        <!-- panel hided content -->
            <div class="panel-footer">

                <!-- toggle form for adding new description type -->
                <div class="text-left">
                    <a class="btn btn-xs btn-info" href="javascript:;" onclick="displayAddUserForm();">Добавить Пользователя</a>
                </div>

                <!-- description type create form wrapper -->
                <div id="user-create-form-wrapper" class="text-left noradius text-danger softhide">

                    <form action="/user" method="post">
                        {{ csrf_field() }}
                        <fieldset>



                            <div class="row form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label for="name" class="col-sm-3">Имя пользователя</label>
                                    <input type="text" name="name" value="" class="form-control required" required>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Логин</label>
                                    <input type="text" name="username" value="" class="form-control required" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label>Пароль</label>
                                    <input type="text" name="password" value="" class="form-control required" required>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Порторить пароль</label>
                                    <input type="text" name="password_confirmation" value="" class="form-control required" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label>ID оператора</label>
                                    <input type="text" name="operator_id" value="" class="form-control required" required>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>ID дежурного</label>
                                    <input type="text" name="chef_id" value="" class="form-control required" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-save white"></i>Сохранить</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>

                <div id="userChangePasswordFormWrapper" class="text-left noradius text-danger softhide">
                    <form id="userChangePasswordForm" action="" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <fieldset>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Пароль</label>
                                        <input type="text" name="password" id="password" value="" class="form-control required" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Порторить пароль</label>
                                        <input type="text" name="password_confirmation" value="" class="form-control required" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-save white"></i>Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <!-- description type update form wrapper -->
                <div id="userEditFormWrapper" class="text-left noradius text-danger softhide">

                    <form id="userEditForm" action="" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <fieldset>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Имя пользователя</label>
                                        <input type="text" name="name" value="" id="name" class="form-control required" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Логин</label>
                                        <input type="text" name="username" id="username" value="" class="form-control required" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>ID оператора</label>
                                        <input type="text" name="operator_id" id="operator_id" value="" class="form-control required" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>ID дежурного</label>
                                        <input type="text" name="chef_id" id="chef_id" value="" class="form-control required" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-save white"></i>Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>


                    <!-- delete description form  -->
                    <form id="delete-user" action="" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>     <!-- /pre code -->
            </div>    <!-- /panel hided content -->
        </div>     <!--  all content div-->
    </div>    <!-- /all content wrapepr-->

    <!-- script section -->
    <script src="{{asset('admin_panel/js/users/master.js')}}"  type="text/javascript"></script>



@endsection



