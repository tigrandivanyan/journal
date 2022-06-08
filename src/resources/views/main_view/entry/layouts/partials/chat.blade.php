


<div  class="alert info-hover-hide" role="alert" hidden id="divForChat" >

    <div class="row">
        <div class="col-md-6 matrixChatMessageList" > {{-- area for chat messages--}}

        </div>
        <div class="col-md-6">
            <form action="{{route('matrix.chat.send')}}" method="POST" id="formForMatrixChat" class="form-horizontal">
                {{ csrf_field() }}
                    <textarea id="textAreaForMatrixChat" name="message" class="form-control" rows="5" style="resize: none;"></textarea>
                    <input type="text" name="studio" value="{{ $studio->name_en}}" hidden>
                    <button type="submit" id="sendMessageToChat" class="btn "> Отправить </button>
            </form>
        </div>
    </div>
    <div class="row row-for-show-all-chat-messages">
        <div class="col-md-6 col-for-show-all-chat-messages" >
            <button type="submit" id="showAllChatMessages" class="btn "> История </button>
        </div>
    </div>

</div>

