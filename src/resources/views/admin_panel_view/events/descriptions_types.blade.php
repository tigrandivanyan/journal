@extends('admin_panel_view.layout.master')
@section('content')

    <header id="page-header">
        <h1>Описание событий</h1>         <!-- page title -->
    </header>

    <div id="content" class="padding-20">     <!-- all content wrapepr-->
        <div id="panel-5" class="panel panel-default">  <!--  all content div-->

            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>Типы описаний</strong>  <!-- panel title -->
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
                    <table class="table table-sm table-striped mt-4">  <!-- all description list-->
                        <thead>
                            <tr>
                                <th>___ID___</th>
                                <th>Название на английском</th>
                                <th>Название на русском</th>
                                <th>Доступно для редактирования</th>
                                <th>Изменить</th>
                                <th>Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($descriptionTypes as $type)
                                <tr>
                                    <td class="description_type_id" data-type-value="{{$type->id}}">{{$type->id}}</td>
                                    <td class="description_type_eng_name" data-type-value="{{$type->id}}">{{$type->eng_name}}</td>
                                    <td class="description_type_ru_name" data-type-value="{{$type->id}}">{{$type->ru_name}}</td>
                                    <td class="description_type_allow_to_edit" data-type-value="{{$type->id}}">{{$type->allow_to_edit}}</td>
                                    <td>   <!-- edit button-->
                                        <a class="btn btn-light btn-outline-secondary btn-sm"
                                           data-type-value="{{$type->id}}"
                                           href="javascript:;"
                                           onclick="editFormDisplay(this); ">
                                            <i class="fa fa-edit white"></i>
                                            Edit
                                        </a>
                                    </td>
                                    <td>  <!-- delete button-->
                                        <a class="btn btn-light btn-outline-secondary btn-sm"
                                           data-type-value="{{$type->id}}"
                                           href="javascript:;"
                                           onclick="deleteFormSubmit(this); ">
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
            <div class="panel-footer mt-4">

                <!-- toggle form for adding new description type -->
                <div style="margin-bottom:20px" class="text-left">
                    <a class="btn btn-xs btn-info" href="javascript:;" onclick="dislayAddDescriptionTypeForm();">Добавить Описание</a>
                </div>

                <!-- description type create form wrapper -->
                <div id="description-type-create-form-wrapper" class="text-left noradius text-danger softhide">

                    <form action="{{route('admin-panel.event-descriptions-types.store')}}" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        {{ csrf_field() }}
                        <fieldset>

                            <div class="row form-group">
                                <label for="eng_name" class="col-sm-3">Короткое название на английском </label>
                                <input type="text" name="eng_name" value="" class="form-control col-sm">
                            </div>

                            <div class="row form-group">
                                <label for="eng_name" class="col-sm-3">Полное название на русском</label>
                                <input type="text" name="ru_name" value="" class="form-control col-sm">
                            </div>


                            <div class="row form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm">
                                    <input type="hidden" name="allow_to_edit" value="0" />
                                    <input type="checkbox" name="allow_to_edit" value="1" >
                                    <label for="allow_to_edit_create">Тип события доступен для редактирования</label>
                                </div>
                            </div>


                            <div class="row form-group">
                                <div class="col-sm-3 mr-3"></div>
                                <div class="col-md-6 col-sm-6">
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
                <div id="descriptionTypeEditFormWrapper" class="text-left noradius text-danger softhide">

                    <form id="descriptionTypeEditForm" action="{{route('admin-panel.event-descriptions-types.update')}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <fieldset>

                            <input type="hidden" id="typeId" name="type_id" class="form-control required">

                            <div class="row form-group">
                                <label for="eng_name" class="col-sm-3">Название на английском</label>
                                <input type="text" id="eng_name" name="eng_name" class="form-control col-sm">
                            </div>

                            <div class="row form-group">
                                <label for="eng_name" class="col-sm-3">Название на русском </label>
                                <input type="text" id="ru_name" name="ru_name" class="form-control col-sm">
                            </div>


                            <div class="row form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm">
                                    <input type="hidden" name="allow_to_edit" value="0" />
                                    <input type="checkbox" name="allow_to_edit" id="allow_to_edit_create" value="1" >
                                    <label for="allow_to_edit_create">Тип события доступен для редактирования</label>
                                </div>
                            </div>


                            <div class="row form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-md-6 col-sm-6">
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
                    <form id="delete-description-type" action="" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <input type="hidden" name="type_id" id="typeIdForDelete">
                    </form>
                </div>     <!-- /pre code -->
            </div>    <!-- /panel hided content -->
        </div>     <!--  all content div-->
    </div>    <!-- /all content wrapepr-->

    <!-- script section -->
    <script src="{{asset('admin_panel/js/description_type/master.js')}}"  type="text/javascript"></script>


@endsection



