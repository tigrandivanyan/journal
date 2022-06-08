@extends('admin_panel_view.layout.master')
@section('content')

    <header id="page-header">
        <h1>Описание событий</h1>   <!-- page title -->
    </header>

    <div id="content" class="padding-20">  <!-- all content wrapper-->

    @include('general_view.errors.post_errors')

    @foreach($studios as $studio)   <!-- looping through all studios -->

        <div id="panel-5" class="panel panel-default">  <!--  all content div -->
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>{{$studio->name_ru}}</strong> <!-- panel title -->
                </span>
                <!-- right options -->
                <ul class="options pull-right list-inline">
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                    <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                </ul>
            </div>

            <div class="panel-body">    <!-- panel content -->
                <div class="table-responsive">
                    <table class="table table-sm table-striped mt-4">
                        <thead>
                        <tr>
                            <th>___ID___</th>
                            <th title="Приоритет устанавливает последовательность отобзажения описаний в меню выбора событий для операторов. 0 - найвысщий приоритет. ">Приоритет</th>
                            <th title="Определяет группу к которому принадлежит событие. ">Клас_описания</th>
                            <th>Текст описания</th>
                            <th>Изменить</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($descriptions as $description)
                            @if($studio->id == $description->studio_id )
                                <tr>
                                    <td class="description_id" data-description-id="{{$description->id}}" data-description-studio-id="{{$studio->id}}">{{$description->id}}</td>
                                    <td class="description_frequency"  data-description-id="{{$description->id}}" data-description-studio-id="{{$studio->id}}">{{$description->frequency}}</td>
                                    <td class="description_type_ru_name"  data-description-id="{{$description->id}}" data-description-studio-id="{{$studio->id}}">{{$description->type->ru_name}}</td>
                                    <td class="description_type_id hidden"  data-description-id="{{$description->id}}" data-description-studio-id="{{$studio->id}}">{{$description->type->id}}</td>
                                    <td class="description_text"  data-description-id="{{$description->id}}" data-description-studio-id="{{$studio->id}}">{{$description->text}}</td>
                                    <td>   <!-- edit button-->
                                        <a class="btn btn-light btn-outline-secondary btn-sm"
                                           data-description-id="{{$description->id}}"
                                           data-description-studio-id="{{$studio->id}}"
                                           href="javascript:;"
                                           onclick="editFormDisplay(this); ">
                                            <i class="fa fa-edit white"></i>
                                            Edit
                                        </a>
                                    </td>
                                    <td>  <!-- delete button-->
                                        <a class="btn btn-light btn-outline-secondary btn-sm"
                                           data-description-id="{{$description->id}}"
                                           data-description-studio-id="{{$studio->id}}"
                                           href="javascript:;"
                                           onclick="deleteFormSubmit(this); ">
                                            <i class="fa fa-times white"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>     <!-- /panel content -->



            <div class="panel-footer">    <!-- panel footer -->


                <div class="text-left">    <!-- pre code -->
                    <a class="btn btn-xs btn-info mt-4 mb-4"
                       href="javascript:;"
                       onclick="jQuery('#pre-{{$studio->name_eng}}').slideToggle();">
                        Добавить Описание
                    </a>
                </div>

                <div id="pre-{{$studio->name_eng}}" class="text-left noradius text-danger softhide">
                    <form class="" action="/admin-panel/description" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        {{ csrf_field() }}
                        <fieldset>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3"
                                       title="Приоритет устанавливает последовательность отобзажения описаний в меню выбора событий для операторов. 0 - найвысщий приоритет.">
                                    Приоритет
                                </label>
                                <input type="number" min="0" name="frequency" value="" class="form-control col-md col-sm">
                            </div>


                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3"
                                       title="Определяет группу к которому принадлежит событие. ">
                                    Клас описания
                                </label>
                                <select  name="type_id" class="form-control col-md col-sm pointer">
                                    <option value="2" selected="selected">--- Выберите ---</option>
                                    @foreach($descriptionTypes as $type){
                                    <option value="{{$type->id}}">{{$type->ru_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Текст описания</label>
                                <input type="text" name="text" value="" class="form-control required col-md col-sm">
                                <input type="hidden" name="studio_id" value="{{$studio->id}}">
                            </div>

                            <div class="row form-group">
                                <div class="col-md-3 col-sm-3"></div>
                                <div class="col-md col-sm">
                                    <button type="submit" class="btn btn-light btn-outline-secondary"><i class="fa fa-save white"></i> Сохранить </button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>

                <div id="edit-{{$studio->id}}" class="text-left noradius text-danger softhide">

                    <form class="" action="" method="post">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <fieldset>
                            <input type="hidden" name="_method" value="patch">

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Приоритет</label>
                                <input type="number"
                                       min="0"
                                       id="form-edit-frequency-{{$studio->id}}"
                                       name="frequency"
                                       value=""
                                       class="form-control col-md col-sm required">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Клас описания</label>
                                <select id="description-type-{{$studio->id}}" name="type_id" class="form-control col-md col-sm pointer">
                                    <option class="form-edit-clas" >--- Выберите ---</option>
                                    @foreach($descriptionTypes as $type){
                                        <option class="for-searching-id" value="{{$type->id}}">{{$type->ru_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Текст описания</label>
                                <input type="text" id="form-edit-text-{{$studio->id}}" name="text" value="" class="form-control col-md col-sm">
                                <input type="hidden" name="studio_id" value="{{$studio->id}}">
                            </div>

                            <div class="row form-group">
                                <div class="col-md-3 col-sm-3"></div>
                                <div class="col-md col-sm">
                                    <button type="submit" class="btn btn-light btn-outline-secondary"><i class="fa fa-save white"></i>Сохранить</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>


                </div>  <!-- /pre code -->
            </div>    <!-- /panel footer -->
        </div>
        @endforeach
    </div>

    <div id="delete-description" class="text-left noradius text-danger softhide">
        <form action="" method="post">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <input type="hidden" name="delete-description-id" id="deleteDescriptionId" >
        </form>
    </div>




    <script src="{{asset('admin_panel/js/descriptions/master.js')}}"  type="text/javascript"></script>

@endsection