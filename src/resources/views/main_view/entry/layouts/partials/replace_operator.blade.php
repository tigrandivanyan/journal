
<div class="modal" tabindex="-1" role="dialog" id="changeOperatorModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Замена оператора на другой студии</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.change-operator')}}" method="POST">
                    @csrf
                    <select name="change_operator_id" class="form-control">
                        @foreach($allstudios as $studioName)
                            <optgroup label="{{$studioName->name_ru}}">
                                @foreach($alloperators as $operator)
                                    @if ($operator->studio_id == $studioName->id)
                                        <option value="{{$operator->id}}">{{$operator->name_ru}}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <br>
                    <button class="btn btn-primary">Заменить оператора</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>