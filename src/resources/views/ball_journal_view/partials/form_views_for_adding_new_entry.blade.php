


    <section class="main-middle-section">



        @if(isset($ballJournalEntry))

            <article class="container mb-5">
                <div  class="container">
                    <h4>Завершить событие - замена комплекта шаров</h4>
                    <hr>
                    <form action="{{route('ball-journal.ball-set-change-complete', $ballJournalEntry->id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p><span class="font-weight-bold">Тип события:</span> <small class="d-inline ml-3 form-text text-muted">{{$ballJournalEntry->type->name_ru}}</small></p>
                        </div>
                        <div class="form-group">
                            <p><span class="font-weight-bold">Дата:</span> <small class="d-inline ml-3 form-text text-muted">{{$ballJournalEntry->date}}</small></p>
                        </div>
                        <div class="form-group">
                            <p><span class="font-weight-bold">Техник:</span> <small class="d-inline ml-3 form-text text-muted">{{ isset($ballJournalEntry->ballTechnician->name_ru) ? $ballJournalEntry->ballTechnician->name_ru : '-' }}</small></p>
                        </div>
                        <div class="form-group">
                            <p><span class="font-weight-bold">Студия:</span> <small class="d-inline ml-3 form-text text-muted">{{ isset($ballJournalEntry->studio->name_ru) ? $ballJournalEntry->studio->name_ru : '-' }}</small></p>
                        </div>
                        <div class="form-group">
                            <p><span class="font-weight-bold">№ комплекта:</span> <small class="d-inline ml-3 form-text text-muted">{{ isset($ballJournalEntry->ball_set_number) ? $ballJournalEntry->ball_set_number : '-' }}</small></p>
                        </div>
                        <div class="form-group">
                            <label for="completeBallSetChangeTime"><span class="font-weight-bold">Время:</span></label><small class="d-inline ml-3 form-text text-muted">Если вы не укажите время, событие по прежнему будет считаться незанченным</small>
                            <button type="button"  class="btn btn-outline-light text-info btn-sm mb-2 set-current-time-for-form">Установить текущее время</button><input type="time" class="form-control" name="time" id="completeBallSetChangeTime">
                        </div>
                        <div class="form-group">
                            <label for="completeBallSetChangeTime"><span class="font-weight-bold">Связать событие с событием из операторской:</span></label>
                            @if($operatorJournalEntries->count() < 1 )
                                <p>Оператор еще не создал запись о событии, запись не может быть завершина</p>
                            @else
                                <select name="operator_journal_entrie_id" class="custom-select" size="{{ $operatorJournalEntries->count() }}">
                                    @foreach($operatorJournalEntries as $operatorJournalEntrie)
                                        <option class=""  value="{{$operatorJournalEntrie->id}}">
                                            <span>Студия:</span> {{$operatorJournalEntrie->studio->name_ru}}
                                            <span>Время:</span> {{$operatorJournalEntrie->time}}
                                            <span>Оператор:</span> {{$operatorJournalEntrie->operator->name_ru}}
                                            <span>Описание:</span> {{$operatorJournalEntrie->description}}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Завершить</button>
                    </form>
                </div>
            </article>

        @endif




        <article class="container hidden-container ball-set-change-event-modal-box mb-5" data-view-type="planed-ball-set">
            <div  class="container">
                <h4>Плановая замена комплекта шаров</h4>
                <hr>
                <form action="{{route('ball-journal.ball-set-change-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="plannedBallSetChangeDate">Дата</label>
                        <input type="date" class="form-control form-date" name="date" id="plannedBallSetChangeDate" >
                    </div>
                    <div class="form-group">
                        <label for="plannedBallSetChangeTime">Время</label><small class="d-inline ml-3 form-text text-muted">Если вы не укажите время, событие будет отмечено как незанченное</small>
                        <button type="button"  class="btn btn-outline-light text-info btn-sm mb-2 set-current-time-for-form">Установить текущее время</button><input type="time" class="form-control" name="time" id="plannedBallSetChangeTime">
                    </div>
                    <div class="form-group">
                        <label  class="form-control-label" for="plannedBallSetChangeStudioName">Студия</label>
                        <select class="form-control" name="studio_id" id="plannedBallSetChangeStudioName">
                           @foreach($allStudios as $studio)
                                <option value="{{$studio->id}}">{{$studio->name_ru}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="plannedBallSetChangeNumber">Номер комплекта шаров</label>
                        <input type="number" class="form-control" name="ball_set_number" id="plannedBallSetChangeNumber">
                    </div>
                    <input type="hidden" name="event_type_id" value="1">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>



        <article class="container hidden-container ball-set-change-event-modal-box mb-5" data-view-type="unplaned-ball-set">
            <div  class="container">
                <h4>Внеплановая замена комплекта шаров</h4>
                <hr>
                <form action="{{route('ball-journal.ball-set-change-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="unplannedBallSetChangeDate">Дата</label>
                        <input type="date" class="form-control form-date" name="date" id="unplannedBallSetChangeDate">
                    </div>
                    <div class="form-group">
                        <label for="plannedBallSetChangeTime">Время</label><small class="d-inline ml-3 form-text text-muted">Если вы не укажите время, событие будет отмечено как незанченное</small>
                        <button type="button"  class="btn btn-outline-light text-info btn-sm mb-2 set-current-time-for-form">Установить текущее время</button><input type="time" class="form-control" name="time" id="plannedBallSetChangeTime">
                    </div>
                    <div class="form-group">
                        <label  class="form-control-label" for="unplannedBallSetChangeStudioName">Студия</label>
                        <select class="form-control" name="studio_id" id="unplannedBallSetChangeStudioName">
                            @foreach($allStudios as $studio)
                                <option value="{{$studio->id}}">{{$studio->name_ru}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unplannedBallSetChangeNumber">Номер комплекта шаров</label>
                        <input type="number" class="form-control" name="ball_set_number" id="unplannedBallSetChangeNumber">
                    </div>
                    <div class="form-group">
                        <label for="unplannedBallSetChangeDescription">Причина замены</label>
                        <textarea  name="description" class="form-control" id="unplannedBallSetChangeDescription" placeholder="Введите текст" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="event_type_id" value="2">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>




        <article class="container hidden-container ball-change-event-modal-box mb-5" data-view-type="ball">
            <div  class="container">
                <h4>Замена шара</h4>
                <hr>
                <form action="{{route('ball-journal.ball-change-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label  class="form-control-label" for="ballChangeStudioName">Студия</label>
                        <select class="form-control" name="studio_id" id="ballChangeStudioName">
                            @foreach($allStudios as $studio)
                                <option value="{{$studio->id}}">{{$studio->name_ru}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ballChangeBallSetNumber">Номер комплекта шаров</label>
                        <input type="text" class="form-control" name="ball_set_number" id="ballChangeBallSetNumber">
                    </div>
                    <div class="form-group">
                        <label for="ballChangeBallNumber">Номер шара</label>
                        <input type="text" class="form-control" name="ball_number" id="ballChangeBallNumber" >
                    </div>
                    <div class="form-group">
                        <label for="ballChangeBallChangeReason">Причину замены шара</label>
                        <select class="form-control" name="ball_change_reason" id="ballChangeBallChangeReason">
                            @foreach($allBallConditions as $conditions)
                                <option value="{{$conditions->id}}">{{$conditions->name_ru}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <small class="form-text text-muted">Время и дата будут установлены автоматически</small>
                    </div>
                    <input type="hidden" name="event_type_id" value="3">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>



        <article class="container hidden-container simple-text-event-modal-box mb-5" data-view-type="technical-message">
            <div  class="container">
                <h4>Техническое сообщение</h4>
                <hr>
                <form action="{{route('ball-journal.technical-message-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="technicalMessageDescription">Текст сообщения</label>
                        <textarea  name="description" class="form-control" id="technicalMessageDescription" placeholder="Введите текст" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="announcement" value="0">
                        <input type="checkbox" value="1" name="announcement" class="form-check-input" id="technicalMessageAnnouncement">
                        <label class="form-check-label" for="technicalMessageAnnouncement">Сделать сообщение объявлением</label>
                    </div>
                    <div class="form-group">
                        <small class="form-text text-muted">Время и дата будут установлены автоматически</small>
                    </div>
                    <input type="hidden" name="event_type_id" value="4">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>



        <article class="container hidden-container ball-set-status-change-event-modal-box mb-5" data-view-type="ball-set-status">
            <div  class="container">
                <h4>Присвоить статус комплекта шаров</h4>
                <hr>
                <form action="{{route('ball-journal.ball-set-status-change-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label  class="form-control-label" for="ballSetStatusChangeStudioName">Студия</label>
                        <select class="form-control" name="studio_id" id="ballSetStatusChangeStudioName">
                            @foreach($allStudios as $studio)
                                <option value="{{$studio->id}}">{{$studio->name_ru}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ballSetStatusChangeBallSetNumber">Номер комплекта шаров</label>
                        <input type="text" class="form-control" name="ball_set_number" id="ballSetStatusChangeBallSetNumber">
                    </div>
                    <div class="form-group">
                        <label for="ballSetStatusChangeCondition">Статус комплекта шаров</label>
                        <select class="form-control" name="ball_set_status" id="ballSetStatusChangeCondition">
                            <option value="1">Активный</option>
                            <option value="0">Не активный</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <small class="form-text text-muted">Время и дата будут установлены автоматически</small>
                    </div>
                    <input type="hidden" name="event_type_id" value="5">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>




        <article class="container hidden-container ball-set-shuffle-event-modal-box mb-5" data-view-type="ball-set-shuffle">
            <div  class="container">
                <h4>Шафл комплектов шаров</h4>
                <hr>
                <form action="{{route('ball-journal.ball-set-shuffle-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="ballSetShuffleDescription">Текст сообщения</label>
                        <input type="hidden" name="description" value="Был произведен шафл комплектов шаров" id="ballSetShuffleDescription" >
                    </div>
                    <div class="form-group">
                        <small class="form-text text-muted">Время, дата и текст будут установлены автоматически</small>
                    </div>
                    <input type="hidden" name="event_type_id" value="6">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>



    </section>





