@extends('admin_panel_view.layout.master')
@section('content')

    <header id="page-header">
        <h1>Конфигурации Matrix</h1>         <!-- page title -->
    </header>

    <div id="content" class="padding-20"> <!-- all content wrapepr-->
        <div id="panel-5" class="panel panel-default">  <!--  all content div-->
            <div class="panel-heading">
                                <span class="title elipsis">
                                    <strong>Все комнаты пользователя --   {{$matrix_username }} </strong>  <!-- panel title -->
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
                    <table class="table table-condensed table-vertical-middle nomargin">  <!-- all rooms list-->
                        <thead>
                        <tr>

                            <th>Room ID</th>
                            <th>Название</th>
                            <th>Подключиться</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allAccesibleRooms as $key=>$value)
                            <tr>
                                <td class="room-id" data-entry-value="{{$value}}">{{$key}}</td>
                                <td class="room-name" data-entry-value="{{$value}}">{{$value}}</td>
                                <td>   <!-- choose button-->
                                    <a class="btn btn-default btn-xs" data-entry-value="{{$value}}" href="javascript:;" onclick="chooseRoomFormSubmit(this); "><i class="fa fa-edit white"></i>Выбрать</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>     <!-- /panel content -->

            <!--  error section -->
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

        <!-- hided content -->
            <div class="panel-footer">
                <!-- save room id form -->
                <div class="text-left noradius text-danger softhide">
                    <form id="choose-room-id" action="{{route('admin.matrix.save')}}" method="post">
                        {{ csrf_field() }}
                        <input id="username" name="username" value="{{$matrix_username }}" class="form-control required">
                        <input id="room_id" name="room_id" >
                        <input id="room_name" name="room_name">
                        <input id="purpose" name="purpose" value="{{$purpose}}">
                    </form>
                </div>
            </div>
        </div>   <!--  /all content div-->
    </div>    <!-- /all content wrapepr-->

    <!-- script section -->
    <script src="{{asset('admin_panel/js/matrix/rooms/master.js')}}"  type="text/javascript"></script>


@endsection



