<div class="modal fade" tabindex="-1" role="dialog" id="addEntryModal">
    <div class="modal-dialog modal-lg" role="document">

        <form action="{{route('entry.store', $studio->name_eng)}}" method="POST" id="newEntryForm"
              class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавить новую запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    {{ csrf_field() }}
                    <div class="row new-entry-div">
                        <!-- Form Left side -->
                        <div class="col-md-6">
                            <div class="div-for-input">
                                <label for="entryTour" class="new-entry-label">Тур</label>
                                <input type="text" name="tour" id="entryTour"
                                       class="new-entry-input new-entry-input-left">

                                <div class="tour-control-button" id="tourPlus" hidden>
                                    <button type="button" class="btn my-btn btn-default">+</button>
                                </div>
                                <div class="tour-control-button" id="tourMinus" hidden>
                                    <button type="button" class="btn my-btn btn-default">-</button>
                                </div>

                            </div>
                            <div class="div-for-input">
                                <label for="entry-date" class="new-entry-label">Дата</label>
                                <input type="text" name="date" id="entryDate"
                                       class="new-entry-input new-entry-input-left">
                            </div>
                            <div class="div-for-input">
                                <label for="entry-time" class="new-entry-label">Время</label>
                                <input type="text" name="time" id="entryTime"
                                       class="new-entry-input new-entry-input-left timeMask">
                            </div>

                            <div class="div-for-input">
                                <label for="name" class="new-entry-label">Дежурный</label>
                                <select name="chef_id" id="chefId" class="new-entry-input new-entry-input-left">
                                    <option value="0">Выберите дежурного</option>
                                    @foreach ($chefs as $chef)
                                        <option value="{{ $chef->id }}">{{ $chef->name_ru }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="studio" value="{{ $studio->name_eng}}"/>
                            <input type="hidden" name="studio_name_ru" value="{{ $studio->name_ru}}"/>
                            <input type="hidden" name="studio_id" value="{{ $studio->id}}"/>
                            <input type="hidden" name="studio_order_id" value="{{ $studio->order}}"/>
                            <input type="hidden" name="rng_id" value="{{ $studio->rng_id}}"/>
                            <input id="currentRngState" type="hidden" name="current_rng_state"/>
                        </div>
                        <!-- Form Right side -->
                        <div class="col-md-6">
                            <!-- Studio Wheel sector choice --------------------------------------------->
                            <div id="sectorTourCorrection" hidden>
                                <fieldset>
                                    <p>Начальное значение: </p>
                                    <label for="radio-1">2</label>
                                    <input class="ui" type="radio" name="radio-1" id="radio-1">
                                    <label for="radio-2">4</label>
                                    <input class="ui" type="radio" name="radio-1" id="radio-2">
                                    <label for="radio-3">6</label>
                                    <input class="ui" type="radio" name="radio-1" id="radio-3">
                                    <label for="radio-4">12</label>
                                    <input class="ui" type="radio" name="radio-1" id="radio-4">
                                    <label for="radio-5">16</label>
                                    <input class="ui" type="radio" name="radio-1" id="radio-5">
                                    <label for="radio-6">24</label>
                                    <input class="ui" type="radio" name="radio-1" id="radio-6">
                                    <label for="radio-7">48</label>
                                    <input class="ui" type="radio" name="radio-1" id="radio-7">
                                </fieldset>

                                <fieldset>
                                    <p>Исправленное значение: </p>
                                    <label for="radio-8">2</label>
                                    <input class="ui" type="radio" name="radio-2" id="radio-8">
                                    <label for="radio-9">4</label>
                                    <input class="ui" type="radio" name="radio-2" id="radio-9">
                                    <label for="radio-10">6</label>
                                    <input class="ui" type="radio" name="radio-2" id="radio-10">
                                    <label for="radio-11">12</label>
                                    <input class="ui" type="radio" name="radio-2" id="radio-11">
                                    <label for="radio-12">16</label>
                                    <input class="ui" type="radio" name="radio-2" id="radio-12">
                                    <label for="radio-13">24</label>
                                    <input class="ui" type="radio" name="radio-2" id="radio-13">
                                    <label for="radio-14">48</label>
                                    <input class="ui" type="radio" name="radio-2" id="radio-14">
                                </fieldset>

                                <fieldset>
                                    <p>ID: </p>
                                    @for ($i = 15; $i < 69; $i++)
                                        <label for="radio-{{ $i }}">{{ $i-15 }}</label>
                                        <input class="ui" type="radio" name="radio-3" id="radio-{{ $i }}">
                                    @endfor
                                </fieldset>
                            </div>

                            <!-- Studio Wheel sector choice  - end  --------------------------------------------->

                            <select name="description_type_id" class="new-entry-input new-entry-input-right" id="entrySelect">
                                <option value="0">Выберите описание события</option>
                                @foreach ($descriptions as $description)
                                    <option class="description-class" data-description-id="{{$description->id}}"
                                            value="{{ $description->type->id }}">{{ $description->text }}</option>
                                @endforeach
                                <option style="color:blue;" class="description-class entry-description-another-problem" value="6">Другая проблема ...</option>
                            </select>
                            <div id="entryTypeSelector" hidden>
                                <select id="entryTypeSelectorSelector" class="new-entry-input new-entry-input-right">
                                    <option>Выберите категорию события</option>
                                    @foreach ($descriptionTypes as $type)

                                        <option class="description-class"
                                                value="{{ $type->id }}">{{ $type->ru_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <textarea name="description" id="entryDescription"
                                      class="new-entry-input new-entry-input-right "></textarea>
                            <div>
                                <button type="submit" id="addTimeIntervalShowBtn" class="btn  btn-xs">
                                    Добавить интервал времени
                                </button>
                                <div class="add-time-interval-div" hidden>
                                    <input type="text" id="entryStartTimePicker" class="timepicker">
                                    <input type="text" id="entryEndTimePicker" class="timepicker">
                                    <button type="submit" id="addTimeIntervalToTextarea" class="btn btn-default btn-xs">
                                        Добавить
                                    </button>
                                </div>
                            </div>
                            <div id="divMarkEntryAsAnnouncement">
                                <label><input type="checkbox" name="announcement" value="1"><span>Отметить как объявление для коллег</span></label>
                            </div>
                        </div>
                        <!-- __END__ Form Right side  ------------------------------------------------------>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary addEntryButton"><i class="fa fa-plus"></i>
                    Записать в журнал
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </form>
    </div>
</div>
<!-- New Entry ADD Form -->