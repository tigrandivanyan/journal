@extends('admin_panel_view.layout.master')
@section('content')
    <script src="{{asset('/js/page_text_editor.js')}}" type="text/javascript" ></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    </script>

    <header id="page-header">
        <h1>Объявление для студийных операторов</h1>   <!-- page title -->
    </header>

    <div id="content" class="padding-20">  <!-- all content wrapper-->

        @include('general_view.errors.post_errors_success')

        <div id="panel-5" class="panel panel-default">  <!--  all content div -->
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>Редактировать</strong> <!-- panel title -->
                </span>
            </div>


            <div class="panel-body">    <!-- panel content -->
                <div class="table-responsive">
                    <form action="{{route('admin-panel.information.notification')}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <label for="expirationDatePicker">Введите дату истечения актуальности объявления:</label>
                        <input type="date" name="expiration" id="expirationDatePicker">
                        <textarea name="content" style="width: 100%;">{{$notification->content}}</textarea>
                        <button type="submit" class="btn btn-light btn-outline-secondary mt-4"><i class="fa fa-save white"></i> Сохранить </button>
                    </form>
                </div>
            </div>     <!-- /panel content -->
        </div>
    </div>
@endsection