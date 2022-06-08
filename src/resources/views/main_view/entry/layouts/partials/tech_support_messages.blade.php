
@if (isset($studio))



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Выберете сообщение для тех. поддержки</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

{{--modal content start--}}

                    <div  class="alert" role="alert"  id="divForBegginers" >
                        <form action="{{route('matrix.send')}}" method="POST" id="" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="text" name="studio" hidden value="{{ $studio->id}}">
                            <div class="row">
                                @foreach($techSupportMessages as $techMsg)
                                    <div class="col-md-6 msg-for-support-wrapper">
                                        <button type="submit" name="chatMessage" value="{{$techMsg->tech_msg_name_ru}} " data-description-id="{{$techMsg->corr_description_id}}" class="btn  btn-sm btn-block msg-for-support">{{$techMsg->tech_msg_name_ru}}</button>
                                    </div>
                                @endforeach
                                <div class="col-md-6 msg-for-support-wrapper">
                                    <div class="tech-suport-specific-msg-wrapper" ><div class="for-middle-align"><span class="tech-suport-specific-msg-span">Введите сообщение:</span> <input class="tech-suport-specific-msg" type="text" name="tech-suport-specific-msg"><button data-studio="{{ $studio->name_ru }}"  data-description-id="0" type="submit" class="btn btn-outline-light tech-suport-specific-msg-sender">Отправить</button></div></div>
                                </div>
                            </div>
                        </form>
                        <hr>



                    </div>

                    <br>
                    <div class="alert alert-success hidden successfully-send-msg-to-support" role="alert">
                        <strong>Сообщение доставлено! </strong>
                    </div>
                    <br>
                    <div class="alert alert-danger hidden un-successfully-send-msg-to-support" role="alert">
                        <strong>Произошла ошибка, попробуйте снова! </strong>
                    </div>
{{--modal content end--}}

                </div>
                <div class="modal-footer hidden successfully-send-msg-to-support-proceed-btn" data-dismiss="modal">
                    <button type="button" class="btn btn-primary">Добавить описание события в журнал</button>
                </div>
            </div>
        </div>
    </div>


@endif