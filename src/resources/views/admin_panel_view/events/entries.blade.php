@extends('admin_panel_view.layout.master')
@section('content')

    <header id="page-header">
        <h1>Все события</h1>   <!-- page title -->
    </header>

    <div id="content" class="padding-20">  <!-- all content wrapper-->

    @include('general_view.errors.post_errors')

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
                        <div class="list-group-item">
                            <p class="m-3 text-primary nav-link entry-filter-event-type">По типу событий <small> ( доступен мультивыбор )</small></p>
                            <form class="form-inline d-none entry-filter-event-type-container">
                                <div class="form-group mx-sm-3 mb-2">
                                    <select class="form-control entry-filter-event-type-submit-select" name="event_type[]" id="studio-name" multiple>
                                        @foreach($eventTypes as $eventType)
                                            <option value="{{$eventType->id}}">{{$eventType->ru_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <a  style="margin-left:20px" type="submit" href="/admin/entries/{{$studio}}?entry_filter_event_type" class="btn btn-primary entry-filter-event-type-submit-button mb-2">Отфильтровать</a>
                            </form>
                        </div>
                        <div class="list-group-item">
                             <p class="m-3 text-primary nav-link entry-filter-time-interval">По временному интервалу</p>
                            <form class="form-inline d-none entry-filter-time-interval-container">
                                <div class="form-group mx-sm-3 mb-2">
                                    <label class="mr-2" for="filterDateStart">От: </label>
                                    <input style="padding-top:1px;" type="date" min="{{ $firstEntryDate }}" id="filterDateStart" class="form-control entry-filter-time-interval-start-input" placeholder="Номер комплекта">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label class="mr-2" for="filterDateEnd">До: </label>
                                    <input style="padding-top:1px;" type="date" min="{{ $firstEntryDate }}"  id="filterDateEnd" class="form-control entry-filter-time-interval-end-input" placeholder="Номер комплекта">
                                </div>
                                <a  style="margin-left:20px" type="submit" href="/admin/entries/{{$studio}}?entry_filter_time_interval" class="btn btn-primary entry-filter-time-interval-submit-button mb-2">Отфильтровать</a>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div class="continer padding-20 padding-top-0">
        <div class="panel-body">    <!-- panel content -->
            <div class="table-responsive">
                @if(count($entries))
                    <table class="table table-condensed table-vertical-middle nomargin">
                        <thead>
                        <tr>
                            <th>___ID___</th>
                            <th>Тур</th>
                            <th>Дата</th>
                            <th>Время</th>
                            <th>Текст</th>
                            <th>Оператор</th>
                            <th>Дежурный</th>
                            <th>Тип</th>
                            <th>Объявление</th>
                            <th>Почта</th>
                            <th>Создано</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($entries as $entry)

                            <tr>
                                <td class="entry_id" data-entry-id="{{$entry->id}}">{{$entry->id}}</td>
                                <td class="entry_tour"  data-entry-id="{{$entry->id}}" >{{$entry->tour}}</td>
                                <td class="entry_date"  data-entry-id="{{$entry->id}}">{{$entry->occurred_at->toTimeString()}}</td>
                                <td class="entry_time"  data-entry-id="{{$entry->id}}">{{$entry->occurred_at->toDateString()}}</td>
                                <td class="entry_description"  data-descrentryiption-id="{{$entry->id}}" >{{$entry->description}}</td>
                                <td class="entry_type"  data-entry-id="{{$entry->id}}" >{{ isset($entry->operator->name_ru) ? $entry->operator->name_ru : '-' }}</td>
                                <td class="entry_type"  data-entry-id="{{$entry->id}}" >{{ isset($entry->chef->name_ru) ? $entry->chef->name_ru : '-' }}</td>
                                <td class="entry_type"  data-entry-id="{{$entry->id}}" >{{ isset($entry->type->ru_name) ? $entry->type->ru_name : '-' }}</td>
                                <td class="entry_mark"  data-entry-id="{{$entry->id}}" >{{$entry->announcement}}</td>
                                <td class="entry_mail"  data-entry-id="{{$entry->id}}" >{{$entry->mail}}</td>
                                <td class="entry_created_ad"  data-entry-id="{{$entry->id}}" >{{$entry->created_at}}</td>
                            </tr>

                        @endforeach
                        @else
                            <div class="alert alert-danger" role="alert">
                                Событий с такими данными нету!
                            </div>
                        @endif
                        </tbody>
                    </table>
                    {{--pagination links--}}
{{--                {{ $entries->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}--}}
                    {!! $entries->links() !!}


            </div>
        </div>     <!-- /panel content -->
    </div>



    <script src="{{asset('admin_panel/js/events_list_by_studios/master.js')}}"  type="text/javascript"></script>


@endsection