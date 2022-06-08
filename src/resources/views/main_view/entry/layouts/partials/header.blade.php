    <div class="header-navbar-wrapper">

        <div class="row">
            <div class="col-md-12 " >
                <div class="btn-group" id="notificationButtonOpenerSmall">
                    @include('general_view.authentication_links.authentication_links_extended')
                </div>
            </div>
        </div>


        <div class="header-wrapper row">
            <div class="col-md-6" >

                <div id="notificationButtonOpener">
                    <button class="btn instructionShowBtn" title="Инструкция для студийных операторов" ><span>Инструкция журнала</span></button>
                    <button class="btn openChat" title="Чат с тех. директором"> <span>Чат</span></button>
                    <button type="button" class="btn " data-toggle="modal" data-target="#changeOperatorModal" title="Функция подмены оператора на другой студии">Заменить оператора</button>

                    <a href="/text/tech-instruction"><button class="btn openTechInstruction" title="Инструкцией для Студийных Операторов"> <span>Операт. инструкция</span></button></a>
                </div>
            </div>

            <div class="col-md-6" >

            <!-- ------ User Auth Links --------   -->
                @include('general_view.authentication_links.authentication_links')

            </div>

            <div class="myHeader rightClassBottom headderTime"></div>
    </div>
    </div>
