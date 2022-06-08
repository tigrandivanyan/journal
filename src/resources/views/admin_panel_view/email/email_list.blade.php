@extends('admin_panel_view.layout.master')
@section('content')

    <header id="page-header">
        <h1>Список адресов</h1>         <!-- page title -->
    </header>

    <div id="content" class="padding-20">     <!-- all content wrapepr-->
        <div id="panel-5" class="panel panel-default">  <!--  all content div-->

            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>Адреса</strong>
                </span>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped mt-4">
                        <thead>
                            <tr>
                                <th title="Идентификатор записи">___ID___</th>
                                <th title="Название или назначение адресата">Название</th>
                                <th title="Адрес электронной почты">Адрес</th>
                                <th title="Статус активности, должен быть установлен как 1, если хотите, что бы почта отправлялась на этот адрес ">Статус</th>
                                <th title="Редактировать запись">Изменить</th>
                                <th title="Удалить запись">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emails as $email)
                                <tr>
                                    <td class="email_id">{{$email->id}}</td>
                                    <td class="email_name">{{$email->name}}</td>
                                    <td class="email_address">{{$email->email}}</td>
                                    <td class="email_status">{{$email->status}}</td>
                                    <td>   <!-- edit button-->
                                        <a class="btn btn-light btn-outline-secondary btn-sm"
                                           href="javascript:;"
                                           onclick="editFormDisplay(this);">
                                            <i class="fa fa-edit white"></i>
                                            Edit
                                        </a>
                                    </td>
                                    <td>  <!-- delete button-->
                                        <a class="btn btn-light btn-outline-secondary btn-sm"
                                           href="javascript:;"
                                           onclick="deleteFormSubmit(this);">
                                            <i class="fa fa-times white"></i>
                                            Delete
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
                    <a class="btn btn-xs btn-info" href="javascript:;" onclick="dislayAddEmailForm();">Добавить Адрес</a>
                </div>
                <br><hr>
                <!-- description type create form wrapper -->
                <div id="email-create-form-wrapper" class="text-left noradius text-danger softhide">

                    <form action="/admin/email" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        {{ csrf_field() }}
                        <fieldset>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Название адреса</label>
                                <input type="text" name="name" value="" class="form-control col-md col-sm">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Адрес</label>
                                <input type="email" name="email" value="" class="form-control col-md col-sm">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3" for="status">Активный</label>
                                <input type="checkbox" name="status" value="1" class="">
                            </div>

                            <div class="row form-group">
                                <div class="col-md-3 col-sm-3"></div>
                                <div class="col-md col-sm">
                                    <button type="submit"
                                            class="btn btn-light btn-outline-secondary">
                                        <i class="fa fa-save white"></i>
                                        Сохранить
                                    </button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>

                <!-- description type update form wrapper -->
                <div id="emailEditFormWrapper" class="text-left noradius text-danger softhide">

                    <form id="emailEditForm" action="" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <input type="hidden" name="_method" value="patch">

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Название адреса</label>
                                <input type="text" id="name" name="name" value="" class="form-control col-md col-sm">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Адрес</label>
                                <input type="email" id="email" name="email" value="" class="form-control col-md col-sm">
                            </div>


                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Активный</label>
                                <input type="checkbox" id="status" name="status" value="1">
                            </div>


                            <div class="row form-group">
                                <div class="col-md-3 col-sm-3"></div>
                                <div class="col-md col-sm">
                                    <button type="submit"
                                            class="btn btn-light btn-outline-secondary">
                                        <i class="fa fa-save white"></i>
                                        Сохранить
                                    </button>
                                </div>
                            </div>

                        </fieldset>
                    </form>

                    <!-- delete description form  -->
                    <form id="delete-email" action="" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <input type="hidden" name="_method" value="delete">
                    </form>
                </div>     <!-- /pre code -->
            </div>    <!-- /panel hided content -->
        </div>     <!--  all content div-->
    </div>    <!-- /all content wrapepr-->

    <!-- script section -->
    <script src="{{asset('admin_panel/js/email/master.js')}}"  type="text/javascript"></script>


@endsection



