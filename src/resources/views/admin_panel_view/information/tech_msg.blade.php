@extends('admin_panel_view.layout.master')
@section('content')

    <header id="page-header">
        <h1>Сообщения для технической поддержки</h1>   <!-- page title -->
    </header>

    <div id="content" class="padding-20">  <!-- all content wrapper-->

    @include('general_view.errors.post_errors')

    @foreach($studios as $studio)   <!-- looping through all studios -->

        <div id="panel-5" class="panel panel-default">  <!--  all content div -->
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>{{$studio->name_ru}}</strong> <!-- panel title -->
                </span>
            </div>

            <div class="panel-body">    <!-- panel content -->
                <div class="table-responsive">
                    <table class="table table-sm table-striped mt-4">
                        <thead>
                        <tr>
                            <th>___ID___</th>
                            <th>Приоритет</th>
                            <th>Название на ENG</th>
                            <th>Название на RU</th>
                            <th>ID описания</th>
                            <th>Изменить</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($techMsg as $msg)
                            @if($studio->id == $msg->studio_id )
                                <tr>
                                    <td class="tech_message_id" data-msg-id="{{$msg->id}}" data-msg-studio-id="{{$studio->id}}">{{$msg->id}}</td>
                                    <td class="tech_message_order"  data-msg-id="{{$msg->id}}" data-msg-studio-id="{{$studio->id}}">{{$msg->order}}</td>
                                    <td class="tech_message_name_ru"  data-msg-id="{{$msg->id}}" data-msg-studio-id="{{$studio->id}}">{{$msg->tech_msg_name_eng}}</td>
                                    <td class="tech_message_name_eng"  data-msg-id="{{$msg->id}}" data-msg-studio-id="{{$studio->id}}">{{$msg->tech_msg_name_ru}}</td>
                                    <td class="tech_message_corresponding_description"  data-msg-id="{{$msg->id}}" data-msg-studio-id="{{$studio->id}}"><?php if (isset($msg->description)){echo $msg->description->text;}?></td>
                                    <td>   <!-- edit button-->
                                        <a class="btn btn-light btn-outline-secondary btn-sm"
                                           data-msg-id="{{$msg->id}}"
                                           data-msg-studio-id="{{$studio->id}}"
                                           href="javascript:;"
                                           onclick="editFormDisplay(this);">
                                            <i class="fa fa-edit white"></i>
                                            Edit
                                        </a>
                                    </td>
                                    <td>  <!-- delete button-->
                                        <a class="btn btn-light btn-outline-secondary btn-sm"
                                           data-msg-id="{{$msg->id}}"
                                           data-msg-studio-id="{{$studio->id}}"
                                           href="javascript:;"
                                           onclick="deleteFormSubmit(this);">
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
                        Добавить Сообщение
                    </a>
                </div>

                <div id="pre-{{$studio->name_eng}}" class="text-left noradius text-danger softhide">
                    <form class="" action="/admin/tech-support" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        {{ csrf_field() }}
                        <fieldset>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Приоритет </label>
                                <input type="number" min="0" name="order" value="" class="form-control col-md col-sm required">
                            </div>


                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Соответствующие описание </label>
                                <select name="description_id" class="form-control col-md col-sm pointer required">
                                    <option value="2" selected="selected">--- Выберите ---</option>
                                        @foreach($descriptions as $description){
                                            @if ($description->studio_id == $studio->id)
                                                <option value="{{$description->id}}">{{$description->text}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Текст на английском</label>
                                <input name="name_eng" value="" class="form-control col-md col-sm required">
                                <input type="hidden" name="studio_id" value="{{$studio->id}}">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Текст на русском</label>
                                <input name="name_ru" value="" class="form-control col-md col-sm required">
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
                                <input type="number" min="0" id="form-edit-order-{{$studio->id}}" name="order" value="" class="form-control col-md col-sm">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Соответствующие описание</label>
                                <select name="description_id" class="form-control col-md col-sm pointer required">
                                    <option value="2" selected="selected">--- Выберите ---</option>
                                        @foreach($descriptions as $description){
                                            @if ($description->studio_id == $studio->id)
                                                <option value="{{$description->id}}">{{$description->text}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Текст на английском</label>
                                <input type="text" id="form-edit-name-eng-{{$studio->id}}" name="name_eng" value="" class="form-control col-md col-sm required">
                                <input type="hidden" name="studio_id" value="{{$studio->id}}">
                            </div>

                            <div class="row form-group">
                                <label class="col-md-3 col-sm-3">Текст на русском</label>
                                <input type="text" id="form-edit-name-ru-{{$studio->id}}" name="name_ru" value="" class="form-control col-md col-sm required">
                            </div>

                            <div class="row form-group">
                                <div class="col-md-3 col-sm-3"></div>
                                <div class="col-md col-sm">
                                    <button type="submit" class="btn btn-light btn-outline-secondary"><i class="fa fa-save white"></i> Сохранить </button>
                                </div>
                            </div>

                        </fieldset>
                    </form>




                </div>  <!-- /pre code -->
            </div>    <!-- /panel footer -->
        </div>
        @endforeach
    </div>

    <div id="delete-texh-msg" class="text-left noradius text-danger softhide">
        <form action="" method="post">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <input type="hidden" name="delete-description-id" id="deleteDescriptionId" >
        </form>
    </div>




    <script src="{{asset('admin_panel/js/technical_messages_for_support/master.js')}}"  type="text/javascript"></script>
@endsection