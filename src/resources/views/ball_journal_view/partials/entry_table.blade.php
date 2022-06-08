

<section class="event_table">
    <table class="table table-sm table-striped">
        <thead>
        <tr>
            <th class="pl-3" scope="col">Дата</th>
            <th scope="col">Время</th>
            <th scope="col">Техник по шарам</th>
            <th scope="col">Тип события</th>
            <th scope="col">Студия</th>
            <th scope="col">№ комплекта</th>
            <th scope="col">№ шара</th>
            <th scope="col">Причина замены шара</th>
            <th scope="col">Статус комплекта <i class="fas fa-info-circle" title="Если статус копплекта установлен на 0, то комплект не используем!!!"></i></th>
            <th scope="col">Примечание</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($allEntries as $entry)
            <tr title="ID: {{$entry->id}}. @if($entry->binded_edited_entry_id != null){{" Это измененная запись, ID её обновленной версии: ".$entry->binded_edited_entry_id }} @endif " class="@if($entry->entry_completion_status === 0){{"bg-warning"}} @endif @if($entry->binded_edited_entry_id != null){{"bg-secondary"}} @endif">

                <td class="pl-3" scope="row">{{ isset($entry->date) ? $entry->date : '-' }}</td>
                <td class="pl-3">{{ isset($entry->time) ? $entry->time : '-' }} </td>
                <td class="pl-3">{{ isset($entry->user) ? $entry->user->name : '-'}}  </td>
                <td class="pl-3">{{ isset($entry->type->name_ru) ? $entry->type->name_ru : '-' }}</td>
                <td class="pl-3">{{ isset($entry->studio->name_ru) ? $entry->studio->name_ru : '-' }}  </td>
                <td class="pl-3">{{ isset($entry->ball_set_number) ? $entry->ball_set_number : '-' }}</td>
                <td class="pl-3">{{ isset($entry->ball_number) ? $entry->ball_number : '-' }}</td>
                <td class="pl-3">{{ isset($entry->ballCondition->name_ru) ? $entry->ballCondition->name_ru : '-' }}  </td>
                <td class="pl-3">{{ isset($entry->ball_set_status) ? $entry->ball_set_status : '-' }}</td>

                <td class="pl-3 table-description">{{$entry->description}}</td>
                <td class="">@if($entry->entry_completion_status === 0)<a  href='{{ route('ball-journal.index', $entry->id ) }}' type='button' class='btn btn-outline-light text-info btn-sm event-complete-button'>Завершить</a>@endif</td>
                <td class="">
                    <?php
                        if(Auth::check()) {
                            $user = Auth::user();
                            if ($user->isAn('ball-technician')) {
                    ?>
                            <button data-entry-type="{{$entry->type->name_eng}}" data-entry-id="{{$entry->id}}" type='button' class='btn btn-outline-light text-info btn-sm event-edit-button'>Edit</button></td>

                <?php }} ?>


            </tr>

        @endforeach


        </tbody>

    </table>

        @if(!count($allEntries))
            <p class="alert alert-primary mt-5">Данных с такими критериями не существует, попробуйте еще раз! </p>
        @endif


</section>

@if(method_exists($allEntries, 'appends' ))
    {{ $allEntries->appends(Request::except('page'))->links() }}
@endif

