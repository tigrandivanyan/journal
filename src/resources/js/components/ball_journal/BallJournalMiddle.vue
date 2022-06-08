<template>
    <header>
        <div class="container">




            <div class="row">
                <div class="col">

                    <button type="button" class="btn btn-outline-light btn-sm btn-block">Плановая замена комплекта шаров</button>
                    <button type="button" class="btn btn-outline-light btn-sm btn-block">Внеплановая замена комплекта шаров</button>
                    <button type="button" class="btn btn-outline-light btn-sm btn-block">Техническое состояние шара</button>
                    <button type="button" class="btn btn-outline-light btn-sm btn-block">Техническое сообщение</button>

                    <!--<button type="button" class="btn btn-secondary btn-block">Плановая замена комплекта шаров</button>-->


                    <!--<div class="btn-group btn-group-vertical">-->

                        <!--<button type="button" class="btn btn-secondary btn-block">Плановая замена комплекта шаров</button>-->
                        <!--<button type="button" class="btn btn-secondary btn-block">Внеплановая замена комплекта шаров</button>-->
                        <!--<button type="button" class="btn btn-secondary btn-block">Техническое состояние шара</button>-->
                        <!--<button type="button" class="btn btn-secondary btn-block">Техническое сообщение</button>-->
                    <!--</div>-->

                </div>
                <div class="col d-flex justify-content-center">

                    <div class="w-100 pl-4 pr-4">

                        <div class="toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="mr-auto">Ivars Mortulevs</strong>
                                <small>5 mins ago</small>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">
                                Content... this is a toast message.
                            </div>
                        </div>


                        <div class="toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="mr-auto">Olegs Samoilenko</strong>
                                <small>5 mins ago</small>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">
                                Content... this is a toast message.
                            </div>
                        </div>

                        <div class="toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="mr-auto">Kirils Naumovs</strong>
                                <small>5 mins ago</small>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">
                                Content... this is a toast message.
                            </div>
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </header>
</template>


<script>

    $(document).ready(function(){

        $('.toast').toast('show');
        // autohide: false

    });



    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "StudioAddForm",
        computed:{
            ...mapGetters(
                [
                    'emel',
                ]
            ),
        },
        methods:{
            ...mapActions(
                [
                    // 'createStudio',
                ]
            ),
        }
    }
</script>

<style scoped>
    .col{
        /*border:1px solid grey;*/
        padding:20px;
    }

    .toast{
        max-width:450px;
    }

    .btn-outline-light{
        color: #424242;
        border:1px solid #959595;
        font-size:1em;
    }

    .btn-outline-light:hover{
        color: #3e3e3e;
        border:1px solid #3e3e3e;

    }

</style>