<aside>

    <ul class="nav flex-column main-menu-list">
        <li class="nav-item">   <!-- studios -->
            <div class="first-level-menu-item">
                <i class="fas fa-video"></i>
                <span>Студии</span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item second-level-menu-item"><a class="nav-link active" href="{{route('admin-panel.studios.index')}}">Все студии</a></li>
           </ul>
        </li>
        <li class="nav-item">   <!-- roles, assigned roles, abilities, permissions -->
            <div class="first-level-menu-item">
                <i class="far fa-id-card"></i> <span>Права и роли</span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.access-structure.roles')}}">Роли</a></li>  <!-- roles -->
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.access-structure.assigned-roles')}}">Назначенные роли</a></li>  <!-- assigned roles -->
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.access-structure.abilities')}}">Права</a></li>  <!-- abilities -->
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.access-structure.permissions')}}">Назначенные права</a></li>  <!-- permissions -->
            </ul>
        </li>
        <li class="nav-item">   <!-- staff -->
            <div class="first-level-menu-item">
                <i class="fas fa-users"></i> <span>Сотрудники</span>


            </div>
            <ul class="nav flex-column">
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.operator.index')}}">Операторы</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.chef.index')}}">Дежурные</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.ball-technician.index')}}">Техники по шарам</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.admin.index')}}">Админы</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.user.index')}}">Все пользователи</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <div class="first-level-menu-item">
                <i class="far fa-calendar-alt"></i>
                <span>События</span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.event-descriptions-types.index')}}">Типы событий</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.description.index')}}">Описания событий по студиям</a></li>
                <hr>
                <div class="first-level-menu-item">
                    <i class="fas fa-file-archive"></i>
                    <span>Архив событий по студиям</span>
                </div>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Список студий</a>
                    <div class="dropdown-menu">
                        @foreach($studiosForBackend as $studio)
                            <a class="nav-link second-level-menu-item" href="{{route('admin-panel.show-entries-in-backend', $studio->id )}}">{{$studio->name_ru}}</a>
                        @endforeach
                    </div>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <div class="first-level-menu-item">
                <i class="fas fa-info-circle"></i>
                <span>Информация</span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.information.instruction')}}">Инструкция журнала</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.information.notification')}}">Обьявление для операторов</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.information.notice')}}">Уведомление для операторов</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.tech-support-msg.index')}}">Сообщения для тех. поддержки</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <div class="first-level-menu-item">
                <i class="far fa-envelope"></i>
                <span>Рассылки</span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.email-index')}}">Почтовые адреса</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.event-description-type-mailing-settings')}}">Настройка рассылки по типу события</a></li>
                <li class="nav-item second-level-menu-item"><a class="nav-link" href="{{route('admin-panel.matrix.index')}}">Riot</a></li>
            </ul>
        </li>

    </ul>


</aside>