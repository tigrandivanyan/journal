<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="/"><span>  На главную</span></a>
                        <a class="dropdown-item" href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            Выйти
                        </a>

                        <form class="dropdown-item" id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </div>
                </li>

            </ul>
        </div>
    </nav>














    {{--<nav>--}}
        {{--<!-- OPTIONS LIST -->--}}
        {{--<ul class="nav pull-right">--}}

            {{--<!-- USER OPTIONS -->--}}
            {{--<li class="dropdown pull-left">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">--}}
                    {{--<i class="main-icon glyphicon glyphicon-user"></i>--}}
                    {{--<span class="user-name">--}}
									{{--<span class="hidden-xs">--}}
										{{--{{ Auth::user()->username }} <i class="fa fa-angle-down"></i>--}}
									{{--</span>--}}
								{{--</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu hold-on-click">--}}
                        {{--<li>--}}
                            {{--<a href="/"><span>  На главную</span></a>--}}
                        {{--</li>--}}
                        {{--<li><a href="{{ url('/logout') }}"--}}
                               {{--onclick="event.preventDefault();--}}
                               {{--document.getElementById('logout-form').submit();">--}}
                                {{--Выйти--}}
                            {{--</a>--}}

                            {{--<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">--}}
                                {{--{{ csrf_field() }}--}}
                            {{--</form>--}}
                        {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<!-- /USER OPTIONS -->--}}

        {{--</ul>--}}
        {{--<!-- /OPTIONS LIST -->--}}

    {{--</nav>--}}

</header>