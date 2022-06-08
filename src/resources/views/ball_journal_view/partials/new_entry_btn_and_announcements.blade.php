
<!-- Button trigger modal -->
<section class="container row">

    <section class="col-4">
        <button type="button" style="background-color:#fff;" class="btn btn-light mb-5 border border-5 border-secondary" data-toggle="modal" data-target=".bd-example-modal-lg">
            <span class="text-black" >Выбрать тип события</span>
        </button>
    </section>

    <section class="announcements-section col-8  @if(isset($ballJournalEntry)) {{'d-none'}}@endif">
        <div class="list-group-item list-group-item-action announcements-wrapper">

                <div href="#" class="list-group-item list-group-item-action flex-column align-items-start active ">
                    <div  class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Объявления</h5>
                        <button type="button" id="showAllAnnouncementsBtn" class="btn btn-primary mb-2">Показать все объявления</button>

                    </div>
                </div>

            @foreach($allAnnouncements as $announcement)

            <div href="#" class="d-none list-group-item list-group-item-action flex-column align-items-start div-announcement-elements">
                <div class="d-flex w-100 justify-content-between">
                    <small class="text-muted">{{$announcement->created_at->diffForHumans()}}<form class="d-inline ml-2" action="{{route('ball-journal.remove-announcement-status', $announcement->id )}}" method="post"><button type="submit"  class="btn d-none btn-outline-light text-info btn-sm mb-2 delete-notification-btn">Удалить</button></form></small>
                </div>
                <p class="mb-1">{{$announcement->description}}</p>
            </div>

            @endforeach

        </div>
    </section>

</section>
