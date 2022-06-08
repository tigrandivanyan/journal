@if(Session::has('message'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" area-hidden="true">&times;                        </button>
        {{ Session::get('message')}}
    </div>
@endif