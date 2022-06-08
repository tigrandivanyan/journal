<section class="mb-5">
        <ul class="nav nav-tabs justify-content-center">

            <li class="nav-item "><div class="dropdown">
                    <a class="btn dropdown-toggle"  type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        @if (Auth::user()){{ Auth::user()->username }}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        @can('access-admin-panel')
                            <li><a class="dropdown-item" href="{{ route('admin-panel.studios.index') }}">Панель администрирования</a></li>
                        @endcan

                        <li><a class="dropdown-item" href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                                Выйти
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="ball_techninian" value="1">
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
                </div></li>
            <li class="nav-item"><a  class="nav-link" href="/ball-journal">Главная страница</a></li>
            <li class="nav-item"><a  class="nav-link" href="/ball-journal/technician-instruction">Техническая инструкция</a></li>
        </ul>
    </section>

