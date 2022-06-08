<!-- Authentication Links -->

<div class="dropdown">
        <button class="btn dropdown-toggle auth-drop-down"  type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
@if (Auth::user()){{ Auth::user()->username }}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{ url('/') }}"><span> На главную</span></a></li>
            @can('access-admin-panel')
                <li><a href="{{ route('admin-panel.studios.index') }}"><span>Панель администрирования</span></a></li>
            @endcan

            @if (Auth::user()->isAn('ball-technician') || Auth::user()->isAn('ball-technician-admin') || Auth::user()->isAn('admin'))
                <li><a href="/ball-journal"><span>Журнал шаров</span></a></li>
            @endif

            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   Выйти
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
@else
        <span>Войти</span>
        <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{ url('/login') }}">Войти</a></li>
        </ul>

    @endif
</div>
