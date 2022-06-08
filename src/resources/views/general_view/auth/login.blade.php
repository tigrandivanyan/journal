@extends('general_view.auth.layout')


@section('content')

    <div class="container d-flex justify-content-center">
        <div class="card" style="width:400px">
            <div class="card-header">Авторизация</div>
            <div class="card-body">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Логин</label>
                        <input id="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" class="form-control" id="password" required >
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>

                @include('general_view.errors.post_errors')

            </div>
        </div>
    </div>

@endsection
