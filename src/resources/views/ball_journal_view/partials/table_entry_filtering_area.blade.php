<section class="main-bottom-section">


    <nav class="navbar navbar-dark bg-dark ">
        <?php
        if(Auth::check()) {
            $user = Auth::user();
            if ($user->isAn('ball-technician-admin')) {
        ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <span class="navbar-text text-white">Фильтрация записей</span>
            <hr>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link entry-filter-ball-set-number" href="">По номеру комплекта</a>
                    <form class="form-inline d-none entry-filter-ball-set-number-container">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="number" class="form-control entry-filter-ball-set-number-submit-input" placeholder="Номер комплекта">
                        </div>
                        <a type="submit" href="ball-journal?entry_filter_ball_set_number" class="btn btn-primary entry-filter-ball-set-number-submit-button mb-2">Отфильтровать</a>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link entry-filter-event-type" href="#">По типу событий</a>
                    <form class="form-inline d-none entry-filter-event-type-container">
                        <div class="form-group mx-sm-3 mb-2">
                            <select class="form-control entry-filter-event-type-submit-select" name="event_type[]" id="studio-name" multiple>
                                @foreach($eventTypes as $eventType)
                                    <option value="{{$eventType->id}}">{{$eventType->name_ru}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a type="submit" href="ball-journal?entry_filter_event_type" class="btn btn-primary entry-filter-event-type-submit-button mb-2">Отфильтровать</a>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link entry-filter-time-interval" href="#">По временному интервалу</a>
                    <form class="form-inline d-none entry-filter-time-interval-container">
                        <div class="form-group mx-sm-3 mb-2">
                            <label class="text-white mr-2" for="filterDateStart">От: </label>
                            <input type="date" id="filterDateStart" class="form-control entry-filter-time-interval-start-input" placeholder="Номер комплекта">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label class="text-white mr-2" for="filterDateEnd">До: </label>
                            <input type="date" id="filterDateEnd" class="form-control entry-filter-time-interval-end-input" placeholder="Номер комплекта">
                        </div>
                        <a type="submit" href="ball-journal?entry_filter_time_interval" class="btn btn-primary entry-filter-time-interval-submit-button mb-2">Отфильтровать</a>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link entry-filter-studio" href="#">По студии</a>
                    <form class="form-inline d-none entry-filter-studio-container">
                        <div class="form-group mx-sm-3 mb-2">
                            <select class="form-control entry-filter-studio-submit-select" name="studio-id" id="studio-name">
                                @foreach($allStudios as $studio)
                                    <option value="{{$studio->id}}">{{$studio->name_ru}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a type="submit" href="ball-journal?entry_filter_studio" class="btn btn-primary entry-filter-studio-submit-button mb-2">Отфильтровать</a>
                    </form>
                </li>
                <li class="nav-item">
                    <a type="submit" href="/ball-journal" class="btn btn-primary entry-filter-studio-submit-button mb-2">Показать все записи</a>
                </li>
            </ul>

        </div>
        <?php }} ?>
    </nav>
</section>

