@extends('admin_panel_view.layout.master')
@section('content')

    <script src="{{asset('/js/page_text_editor.js')}}" type="text/javascript" ></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    </script>

    <header id="page-header">
        <h1>Инструкция к элетронному журналу</h1>   <!-- page title -->
    </header>

    <div id="content" class="padding-20">  <!-- all content wrapper-->

        @include('general_view.errors.post_errors_success')

        <div id="panel-5" class="panel panel-default">  <!--  all content div -->
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>Редактировать</strong> <!-- panel title -->
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
                    <form action="{{route('admin-panel.information.instruction')}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                    <textarea name="content" style="width: 100%;">{{$instruction->content}}</textarea>
                    <button type="submit" class="btn btn-light btn-outline-secondary mt-4"><i class="fa fa-save white"></i> Сохранить </button>

                    </form>
                </div>
            </div>     <!-- /panel content -->
        </div>
    </div>



@endsection