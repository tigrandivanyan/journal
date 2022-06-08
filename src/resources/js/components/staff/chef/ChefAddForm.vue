<template>
    <div class="container-fluid">

        <button v-if="!addChefFormDisplayStatus && !editChefFormDisplayStatus && !restoreChefTableDisplayStatus" class="btn btn-light btn-outline-secondary mt-4 mb-4" @click="showAddChefForm">Создать нового дежурного</button>

        <form v-show="addChefFormDisplayStatus" class="form-horizontal form-width mt-4">

            <div class="row form-group">
                <label for="username" class="col-sm-3 control-label">Логин дежурного</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newChef.username" id="username" placeholder="Chef username">
                    <span class="red-text" v-if="validationErrors.username" v-text="validationErrors.username[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_ru" class="col-sm-3 control-label">Имя дежурного RU</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newChef.name_ru" id="name_ru" placeholder="Chef name RU">
                    <span class="red-text" v-if="validationErrors.name_ru" v-text="validationErrors.name_ru[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_lv" class="col-sm-3 control-label">Имя дежурного LV</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newChef.name_lv" id="name_lv" placeholder="Chef name LV">
                    <span class="red-text" v-if="validationErrors.name_lv" v-text="validationErrors.name_lv[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="number" class="col-sm-3 control-label">Телефонный номер</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newChef.number" id="number" placeholder="Chef number">
                    <span class="red-text" v-if="validationErrors.number" v-text="validationErrors.number[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="password" class="col-sm-3 control-label">Пароль</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newChef.password" id="password" placeholder="Chef password">
                    <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="password_confirmation" class="col-sm-3 control-label">Повторите пароль</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newChef.password_confirmation" id="password_confirmation" placeholder="Chef password again">
                    <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="col-sm-offset-2 col-sm-8">
                    <button @click.prevent="createChef(newChef)" type="submit" class="btn btn-light btn-outline-secondary">Создать дежурного</button>
                </div>
                <div class="col-sm-2">
                    <button @click.prevent="hideAddChefForm" type="submit" class="btn btn-light btn-outline-secondary pull-right">Отмена</button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "ChefAddForm",
        computed:{
            ...mapGetters(
                [
                    'validationErrors',
                    'addChefFormDisplayStatus',
                    'newChef',
                    'editChefFormDisplayStatus',
                    'restoreChefTableDisplayStatus'
                ]
            ),
        },
        methods:{
            ...mapActions(
                [
                    'createChef',
                    'showAddChefForm',
                    'hideAddChefForm'
                ]
            ),
        }
    }
</script>

<style scoped>

    .form-width{
        max-width:1000px;
    }

</style>