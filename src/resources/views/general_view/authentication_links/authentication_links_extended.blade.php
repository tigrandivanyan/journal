<!-- Authentication Links -->

<div class="dropdown">
        <button class="btn dropdown-toggle auth-drop-down" data-operator-name="{{ Auth::user()->username}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
@if (Auth::user()){{ Auth::user()->username }}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{ url('/') }}" title="Вернуться на главную страницу для просмотра всех студий"><span> На главную</span></a></li>
            <li><a type="button" class="instructionShowBtn" title="Инструкция для студийных операторов"><span>Инструкция</span></a></li>
            <li><a type="button"  data-toggle="modal" data-target="#changeOperatorModal" title="Функция подмены оператора на другой студии">Заменить оператора</a></li>
            <li><a type="button" class="openChat" title="Час с тех. директором"><span>Чат</span></a></li>
            <li> <a href="/text/tech-instruction" title="Инструкцией для Студийных Операторов"> <span>Операт. инструкция</span></a></li>



            <li role="separator" class="divider"></li>
            @can('access-admin-panel')
                <li><a href="{{ route('admin-panel.studios.index') }}"><span>Панель администрирования</span></a></li>
            @endcan
            @if (Auth::user()->isAn('ball-technician') || Auth::user()->isAn('ball-technician-admin') || Auth::user()->isAn('admin'))
                <li><a href="/ball-journal"><span>Журнал шаров</span></a></li>
            @endif
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
        Войти
        <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{ url('/login') }}">Войти</a></li>
        </ul>
@endif
</div>
