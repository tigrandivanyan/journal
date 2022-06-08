<!-- Entrie list -->

    <div class="panel panel-default">
        <?php  // dd($descriptionTypes);?>
        <!-- Фильтр записей + форма отправки -->
            <div class="btn-group-vertical tn-group-sm vertical-button-group" style="width:100%;" role="group" aria-label="...">

                <a href="{{route('studio.filter', $studio->name_eng)}}?criteria=allEntries" type="button" class="btn btn-default btn-sm" value="allEntries">Все</a></button>
                <a href="{{route('studio.filter', $studio->name_eng)}}?criteria=todayEntries" type="button" class="btn btn-default btn-sm" value="todayEntries">За сегодня</a></button>
                <a href="{{route('studio.filter', $studio->name_eng)}}?criteria=yesterdayEntries" type="button" class="btn btn-default btn-sm" value="yesterdayEntries">За вчера</a></button>
                <a href="{{route('studio.filter', $studio->name_eng)}}?criteria=weekEntries" type="button" class="btn btn-default btn-sm" value="weekEntries">За неделю</a></button>
                <a href="{{route('studio.filter', $studio->name_eng)}}?criteria=monthEntries" type="button" class="btn btn-default btn-sm" value="monthEntries">За месяц</a></button>
                <a type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    По типу <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    @foreach($descriptionTypes as $type)
                        <li><a href="{{route('studio.filter', $studio->name_eng)}}?entryType={{$type->id}}">{{$type->ru_name}}</a></li>
                        <li role="separator" class="divider"></li>
                    @endforeach
                </ul>
            </div>

        <div class="btn-group btn-group-justified  btn-group-sort horizontal-button-group" role="group" aria-label="...">

            <div class="btn-group  <?php if ($entryType) {
    echo 'actime-menu-link';
}?>">
                <button type="button" class="btn dropdown-toggle entryTableSortType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    По типу <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    @foreach($descriptionTypes as $type)
                        <li><a href="/studio/{{$studio->name_eng}}?entryType={{$type->id}}">{{$type->ru_name}}</a></li>
                        <li role="separator" class="divider"></li>
                    @endforeach
                </ul>
            </div>


            <div class="btn-group {{($criteria && $criteria != 'allEntries') ?: 'actime-menu-link'}}" role="group">
               <button type="button" class="btn entryTableSort" value="allEntries">Все</button>
            </div>
            <div class="btn-group {{$criteria != 'todayEntries' ?: 'actime-menu-link'}}" role="group">
                <button type="button" class="btn entryTableSort" value="todayEntries">За сегодня</button>
            </div>
            <div class="btn-group <?php if ($criteria == 'yesterdayEntries') {
    echo 'actime-menu-link';
}?>" role="group">
                <button type="button" class="btn entryTableSort" value="yesterdayEntries">За вчера</button>
            </div>
            <div class="btn-group <?php if ($criteria == 'weekEntries') {
    echo 'actime-menu-link';
}?>" role="group">
                <button type="button" class="btn entryTableSort" value="weekEntries">За неделю</button>
            </div>
            <div class="btn-group <?php if ($criteria == 'monthEntries') {
    echo 'actime-menu-link';
}?>" role="group">
                <button type="button" class="btn entryTableSort" value="monthEntries">За месяц</button>
            </div>
            <div class="btn-group date-picker-div <?php if ($criteria == 'dateEntries') {
    echo 'actime-menu-link';
}?>" role="group">
                <button type="button" class="btn entryTableSortSpecial" value="dateEntries">По дате</button>
                <input type="text" id="datepicker" hidden >
            </div>

        </div>
        <form action="{{route('studio.filter', $studio->name_eng )}}" method="GET" id="entrieSort" class="entrieSort" hidden>
            <input type="text" id="criteriaName" name="criteria" value=""  />
            <input type="text" id="criteriaDate" name="criteriadate" value=""  />
            <button type="submit" class="hiddenButton piu">Submit</button>
        </form>
@if (count($entries) > 0)
        <div class="panel-body">
            <table class="table table-striped table-sm task-table table-responsive">
                <!-- Шапка таблицы -->
                <thead>
                    <th>Тур</th> <th>Число</th> <th>Время</th> <th>Оператор</th><th>Описание</th>
                </thead>
                <!-- Тело таблицы -->
                <tbody class="entry-list-tbody">
                @foreach ($entries as $entry)
                    <tr class="entry-table-row">
                        <!-- Имя задачи -->
                        <td data-label="Тур" data-entry-id="{{ $entry->id }}" class="table-text tourForPicker">{{ $entry->tour }}</td>
                        <td data-label="Число" data-entry-id="{{ $entry->id }}" class="table-text  tableDateSize">{{ $entry->occurred_at->toDateString() }}</td>
                        <td data-label="Время" data-entry-id="{{ $entry->id }}" class="table-text timeForPicker">{{ $entry->occurred_at->toTimeString() }}</td>
                        <td data-label="Оператор" data-entry-id="{{ $entry->id }}" class="table-text operator-name">
                                @if($entry->chef_id && isset($entry->chef->name_ru))
                                    {{$entry->chef->name_ru}}
                                @else
                                    @if(isset($entry->user_id) && isset($entry->user->operator->name_ru))
                                        {{$entry->user->operator->name_ru}}
                                    @else
                                        @if(isset($entry->user->username))
                                            {{$entry->user->username}}
                                        @else
                                            {{"Аноним"}}
                                        @endif
                                    @endif
                                @endif
                        </td>
                        <td data-label="Описание" data-entry-id="{{ $entry->id }}" class="table-text  @if ($entry->announcement) announcementStyle @endif ">{{ $entry->description }}</td>

                        <!-- Кнопка Редактирование записи -->

                        <td class="entry-announcement-mark" data-label-for-edit="announcement" hidden  data-entry-id="{{ $entry->id}}">{{ $entry->announcement}}</td>
                        <td class="entry-table-edit-column" data-entry-id="{{ $entry->id }}">
                            @if($entry->type['allow_to_edit'] != 0)
                                @can('edit', $entry)
                                    <button  class="btn editButton unvisible-entry-edit-btn"  data-entry-id="{{ $entry->id }}">Редактировать</button>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- Пагинация -->
            {!! $entries->appends( compact('criteriadate', 'criteria','entryType','announcement') )->links() !!}
            {{--{{ $entries->appends(['sort' => 'votes'])->links() }}--}}
        </div>
    </div>
    <div  class="hiddenTd editEntryTd">
        <div  class="entry-edit-form-wrapper">
            <form action="{{route('entry.update', [$studio->name_eng, $entry->id] )}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="div-for-edit-input">
                <label for="entry-tour" class="newEntryLabel">Тур</label>
                <input name="tour" id="entry-tour" class="newEntryInput">
            </div>
            <div class="div-for-edit-input">
                <label for="entry-date" class="newEntryLabel">Дата</label>
                <input name="date" id="entry-date" class="newEntryInput">
            </div>
            <div class="div-for-edit-input">
                <label for="entry-time" class="newEntryLabel">Время</label>
                <input name="time" id="entry-time" class="newEntryInput" >
            </div>
            <textarea name="description" id="entry-description"  class="div-for-edit-textarea"></textarea>

            <div id="divForCheckbox">
                <input type="hidden" name="announcement" value="0">
                <label><input type="checkbox" name="announcement" id="announcement" value="1"><span>Отметить как объявление для коллег</span></label>
            </div>
            <input type="hidden" name="entry_id" id="entry_id">
            <button type="submit" id="updateEntrySubmitBtn" class="btn "><i class="fa fa-plus"></i> Сохранить изменения</button>
            <button id="updateEntryCancelBtn" class="btn hideTdBtn">Отмена</button>
        </form>

        </div>
    </div>
@else
    <div class="alert alert-warning" style="margin-top:15px">
        <div id="noResultsDiv" style="margin:5px 50px;">Данных с таким запросом не существует, попробуйте еще раз!</div>
    </div>
@endif