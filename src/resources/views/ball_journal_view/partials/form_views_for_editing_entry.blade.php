

    <section class="edit-entry-section">


        <article class="container hidden-container ball-set-planned-change-edit-modal mb-5" data-view-type="planed-ball-set-edit">
            <div  class="container">
                <h4>Плановая замена комплекта шаров - Исправление</h4>
                <hr>
                <form action="{{route('ball-journal.ball-set-change-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="plannedBallSetChangeDateEdit">Дата</label>
                        <input type="date" class="form-control form-date" name="date" id="plannedBallSetChangeDateEdit" >
                    </div>
                    <div class="form-group">
                        <label for="plannedBallSetChangeTimeEdit">Время</label>
                        <input type="time" class="form-control" name="time" id="plannedBallSetChangeTimeEdit">
                    </div>
                    <div class="form-group">
                        <label  class="form-control-label" for="plannedBallSetChangeStudioNameEdit">Студия</label>
                        <select class="form-control" name="studio_id" id="plannedBallSetChangeStudioNameEdit">
                           @foreach($allStudios as $studio)
                                <option value="{{$studio->id}}">{{$studio->name_ru}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="plannedBallSetChangeNumberEdit">Номер комплекта шаров</label>
                        <input type="number" class="form-control" name="ball_set_number" id="plannedBallSetChangeNumberEdit">
                    </div>
                    <input type="hidden" name="event_type_id" value="1">
                    <input type="hidden" class="planned-ball-set-change-edit-entry_id" name="entry_id" value="">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>



        <article class="container hidden-container ball-set-unplanned-change-edit-modal mb-5" data-view-type="unplaned-ball-set-edit">
            <div  class="container">
                <h4>Внеплановая замена комплекта шаров - Исправление</h4>
                <hr>
                <form action="{{route('ball-journal.ball-set-change-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="unplannedBallSetChangeDateEdit">Дата</label>
                        <input type="date" class="form-control form-date" name="date" id="unplannedBallSetChangeDateEdit">
                    </div>
                    <div class="form-group">
                        <label for="unplannedBallSetChangeTimeEdit">Время</label>
                        <input type="time" class="form-control" name="time" id="unplannedBallSetChangeTimeEdit">
                    </div>
                    <div class="form-group">
                        <label  class="form-control-label" for="unplannedBallSetChangeStudioNameEdit">Студия</label>
                        <select class="form-control" name="studio_id" id="unplannedBallSetChangeStudioNameEdit">
                            @foreach($allStudios as $studio)
                                <option value="{{$studio->id}}">{{$studio->name_ru}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unplannedBallSetChangeNumberEdit">Номер комплекта шаров</label>
                        <input type="number" class="form-control" name="ball_set_number" id="unplannedBallSetChangeNumberEdit">
                    </div>
                    <div class="form-group">
                        <label for="unplannedBallSetChangeDescriptionEdit">Причина замены</label>
                        <textarea  name="description" class="form-control" id="unplannedBallSetChangeDescriptionEdit" placeholder="Введите текст" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="event_type_id" value="2">
                    <input type="hidden" class="unplanned-ball-set-change-edit-entry_id" name="entry_id" value="">

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>




        <article class="container hidden-container ball-change-event-modal mb-5" data-view-type="ball-edit">
            <div  class="container">
                <h4>Замена шара - Исправление</h4>
                <hr>
                <form action="{{route('ball-journal.ball-change-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label  class="form-control-label" for="ballChangeStudioNameEdit">Студия</label>
                        <select class="form-control" name="studio_id" id="ballChangeStudioNameEdit">
                            @foreach($allStudios as $studio)
                                <option value="{{$studio->id}}">{{$studio->name_ru}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ballChangeBallSetNumberEdit">Номер комплекта шаров</label>
                        <input type="text" class="form-control" name="ball_set_number" id="ballChangeBallSetNumberEdit">
                    </div>
                    <div class="form-group">
                        <label for="ballChangeBallNumberEdit">Номер шара</label>
                        <input type="text" class="form-control" name="ball_number" id="ballChangeBallNumberEdit" >
                    </div>
                    <div class="form-group">
                        <label for="ballChangeBallChangeReasonEdit">Причину замены шара</label>
                        <select class="form-control" name="ball_change_reason" id="ballChangeBallChangeReasonEdit">
                            @foreach($allBallConditions as $conditions)
                                <option value="{{$conditions->id}}">{{$conditions->name_ru}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <small class="form-text text-muted">Время и дата будут установлены автоматически</small>
                    </div>
                    <input type="hidden" name="event_type_id" value="3">
                    <input type="hidden" class="ball-change-edit-entry_id" name="entry_id" value="">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>



        <article class="container hidden-container simple-text-event-edit-modal mb-5" data-view-type="technical-message-edit">
            <div  class="container">
                <h4>Техническое сообщение - Исправление</h4>
                <hr>
                <form action="{{route('ball-journal.technical-message-store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="technicalMessageDescriptionEdit">Текст сообщения</label>
                        <textarea  name="description" class="form-control" id="technicalMessageDescriptionEdit" placeholder="Введите текст" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="announcement" value="0">
                        <input type="checkbox" value="1" name="announcement" class="form-check-input" id="technicalMessageAnnouncementEdit">
                        <label class="form-check-label" for="technicalMessageAnnouncementEdit">Сделать сообщение объявлением</label>
                    </div>
                    <div class="form-group">
                        <small class="form-text text-muted">Время и дата будут установлены автоматически</small>
                    </div>
                    <input type="hidden" name="event_type_id" value="4">
                    <input type="hidden" class="technical-message-edit-entry_id" name="entry_id" value="">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </article>



    </section>





