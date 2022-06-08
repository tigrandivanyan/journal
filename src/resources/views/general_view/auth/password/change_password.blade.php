@extends('general_view.auth.layout')


@section('content')

    <div class="container d-flex justify-content-center">
        <div class="card" style="width:400px">
            <div class="card-header">Чтобы продолжить работу, вам необходимо сменить пароль</div>
            <div class="card-body">

                <form method="POST" action="{{ route('user-change-password-post') }}">
                    @csrf
                    <div class="form-group">
                        <label for="password">Новый пароль</label>
                        <input type="password" id="password" class="form-control" name="password" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Повторите пароль</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required >
                    </div>
                    <button type="submit" class="btn btn-primary">Изменить пароль</button>
                </form>

                @include('general_view.errors.post_errors')

            </div>
        </div>
    </div>

@endsection