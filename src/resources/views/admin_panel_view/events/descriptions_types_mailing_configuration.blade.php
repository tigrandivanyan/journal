@extends('admin_panel_view.layout.master')
@section('content')

    <header id="page-header">
        <h1>Настройка почтовой рассылки по типам событий</h1>         <!-- page title -->
    </header>

    <div id="content" class="padding-20">     <!-- all content wrapepr-->
        <div id="panel-5" class="panel panel-default">  <!--  all content div-->

            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>Типы событий</strong>  <!-- panel title -->
                </span>
            </div>
            <div class="panel-body">  <!-- panel content -->
                <div class="table-responsive">
                    <table class="table table-sm table-striped mt-4">  <!-- all description list-->
                        <thead>
                        <tr>
                            <th>___ID___</th>
                            <th>Название на английском</th>
                            <th>Название на русском</th>
                            <th>Участвует в почтовой рассылке</th>
                            <th>Изменить</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($descriptionTypes as $type)
                                <tr data-type-value="{{$type->id}}">
                                    <td class="description_type_id" data-type-value="{{$type->id}}">{{$type->id}}</td>
                                    <td class="description_type_eng_name" data-type-value="{{$type->id}}">{{$type->eng_name}}</td>
                                    <td class="description_type_ru_name" data-type-value="{{$type->id}}">{{$type->ru_name}}</td>
                                    <td class="description_type_email" data-type-value="{{$type->id}}">{{$type->email}}</td>
                                    <td>   <!-- edit button-->
                                        <a class="btn btn-light btn-outline-secondary btn-sm"
                                           data-type-value="{{$type->id}}"
                                           href="javascript:;"
                                           onclick="editButtonPress(this);">
                                            <i class="fa fa-edit white"></i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>     <!-- /panel content -->


        @include('general_view.errors.post_errors')
        @include('general_view.errors.session_messages')

        <!-- panel hided content -->

                <hr>
                <div id="descriptionTypeEditFormWrapper" class="text-left noradius softhide">

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="list-group">
                                <span class="list-group-item active">
                                    Название на английском:
                                </span>
                                <span id="eng_name" class="list-group-item">Dapibus ac facilisis in</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="list-group">
                                <span class="list-group-item active">
                                    Название на русском:
                                </span>
                                <span id="ru_name" class="list-group-item">Dapibus ac facilisis in</span>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="margin-top:20px">
                        <div class="col-md-6 col-sm-6">
                            <form  id="descriptionTypeEditForm" action="{{route('admin-panel.event-description-type-mailing-settings-update')}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('patch') }}
                            <div class="form-group">
                                <div class="list-group">
                                    <span class="list-group-item active">
                                        Статус рассылки:
                                    </span>
                                    <input type="hidden" name="email" value="0">
                                    <label class="text-warning list-group-item" for="status">Тип события учавствует в рассылке   <input type="checkbox" name="email" id="descriptionTypeMailingStatus" value="1" ></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="hidden" id="typeId" name="type_id" class="form-control required">
                                <button type="submit" class="btn btn-light btn-outline-secondary"><i class="fa fa-save white"></i> Сохранить </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>     <!-- /pre code -->
        </div>     <!--  all content div-->
    </div>    <!-- /all content wrapepr-->

    <!-- script section -->
    <script src="{{asset('admin_panel/js/description_type_mailing_configuration/master.js')}}"  type="text/javascript"></script>

@endsection



