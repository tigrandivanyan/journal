<template>
    <header>
        <div class="container">

            <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                <a class="navbar-brand" href="#">Ivars Mortulevs</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Техническая интсрукция</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Главная страница</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Выйти</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>
    </header>
</template>

<script>

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

    .navbar{
        margin-bottom:10px;
    }
</style>