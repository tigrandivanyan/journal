@extends('admin_panel_view.layout.master')
@section('content')

    <div id="app">

        <header id="page-header">
            <h1>Все события студии:<span class="text-underline">Keno</span></h1>   <!-- page title -->
        </header>

        <div id="content" class="padding-20">  <!-- all content wrapper-->

            <div id="panel-5" class="panel panel-default">  <!--  all content div -->

                <div class="panel-heading">
                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                        <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                    </ul>
                </div>



                <div class="panel-body border-bottom-1">
                    <section class="main-bottom-section">
                        <div class="list-group">
                            <span class="list-group-item active">Фильтрация:</span>


                            <show_entries_by_studio_type_filter></show_entries_by_studio_type_filter>
                            <show_entries_by_studio_date_filter></show_entries_by_studio_date_filter>



                        </div>
                    </section>
                </div>


            </div>
        </div>


        <div class="continer padding-20 padding-top-0">


            <show_entries_by_studio_list></show_entries_by_studio_list>


        </div>





    </div>

@endsection