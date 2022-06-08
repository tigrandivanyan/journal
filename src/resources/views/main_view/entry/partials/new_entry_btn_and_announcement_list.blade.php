
<div id="alertTable" class="row">
    <div class="col-md-6">
        <div class="row second-btn-row">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" title="Выбрать сообщение для тех. поддержки">Оповестить тех. поддержку и Добавить</button>
            <button type="button" class="btn btn-info show-form-btn" data-toggle="modal" data-target="#addEntryModal" title="Добавить новую запись в журнал">Добавить</button>
            {{--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#timeBreakModal" title="Просмотр статуса дежурного и перерывов операторов">Перерывы</button>--}}
        </div>
    </div>
    <div id="alertPanelLeft" class="panel col-md-6">
        <section class="announcements-section ">
            <div class="list-group-item-action announcements-wrapper">
                <div href="#" class="list-group-item list-group-item-action flex-column align-items-start active ">
                    <div class="justify-content-between">
                        <section class="row">
                            <section class="col-md-6" style="margin-bottom:0;"><h5 style="line-height:24px;">Объявления</h5></section>
                            <section class="col-md-6" style="margin-bottom:0;">
                                <div class="btn-group justify-content-end" style="float:right" role="group">
                                    <button type="button" style="margin-right:0; font-size: 13px;" id="showAllAnnouncementsBtn" class="btn btn-primary" title="Отобразить все актуальные объявления">Актуальные</button>
                                    <a style="margin:5px 0; font-size: 13px;" type="button" class="btn btn-primary" href="{{route('studio.filter', $studio->name_eng)}}?announcement=all" title="Отобразить историю всех объявлений">История</a>
                                </div>
                            </section>
                        </section>
                    </div>
                </div>
                @foreach($announcements as $announcement)

                    <div href="#" class="hidden list-group-item list-group-item-action flex-column align-items-start div-announcement-elements">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="text-muted">{{$announcement->created_at->diffForHumans()}}
                                <form class="d-inline ml-2" action="{{route('entry.unalert-entry', [$studio->name_eng, $announcement->id] )}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn hidden btn-outline-light text-info btn-sm mb-2 delete-notification-btn">
                                        Удалить
                                    </button>
                                </form>
                            </small>
                        </div>
                        <p class="mb-1">{{$announcement->description}}</p>
                    </div>

                @endforeach
            </div>
        </section>
    </div>
</div>