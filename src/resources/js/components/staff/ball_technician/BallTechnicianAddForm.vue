<template>
    <div class="container-fluid mt-4">

        <button
            v-if="!editBallTechnicianFormDisplayStatus &&
             !restoreBallTechniciansTableDisplayStatus &&
             !addBallTechnicianFormDisplayStatus"
            class="btn btn-light btn-outline-secondary"
            @click="showAddBallTechnicianForm">
            Создать нового техника по шарам
        </button>

        <form v-show="addBallTechnicianFormDisplayStatus" class="form-horizontal form-width mt-4">

            <div class="row form-group">
                <label for="username" class="col-sm-3 control-label">Логин техника по шарам</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newBallTechnician.username" id="username" placeholder="Ball technician username">
                    <span class="red-text" v-if="validationErrors.username" v-text="validationErrors.username[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_ru" class="col-sm-3 control-label">Имя техника по шарам RU</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newBallTechnician.name_ru" id="name_ru" placeholder="Ball technician name RU">
                    <span class="red-text" v-if="validationErrors.name_ru" v-text="validationErrors.name_ru[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_lv" class="col-sm-3 control-label">Имя техника по шарам LV</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newBallTechnician.name_lv" id="name_lv" placeholder="Ball technician name LV">
                    <span class="red-text" v-if="validationErrors.name_lv" v-text="validationErrors.name_lv[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="number" class="col-sm-3 control-label">Телефонный номер</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newBallTechnician.number" id="number" placeholder="Ball technician number">
                    <span class="red-text" v-if="validationErrors.number" v-text="validationErrors.number[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="password" class="col-sm-3 control-label">Пароль</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newBallTechnician.password" id="password" placeholder="Ball technician password">
                    <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="password_confirmation" class="col-sm-3 control-label">Повторите пароль</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newBallTechnician.password_confirmation" id="password_confirmation" placeholder="Ball technician password again">
                    <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-3 mr-3"></div>
                <div class="col-sm">
                    <input v-model="newBallTechnician.ball_tech_admin" type="checkbox" class="form-check-input" id="checkboxForNewRole">
                    <label class="form-check-label" for="checkboxForNewRole">Сделать техника администратором журнала по шарам</label>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="col-sm-offset-2 col-sm-8">
                    <button
                        @click.prevent="createBallTechnician(newBallTechnician)"
                        type="submit"
                        class="btn btn-light btn-outline-secondary">
                        Создать техника по шарам
                    </button>
                </div>
                <div class="col-sm-2">
                    <button
                        @click.prevent="hideAddBallTechnicianForm"
                        type="submit"
                        class="btn btn-light btn-outline-secondary">
                        Отмена
                    </button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "BallTechnicianAddForm",
        computed:{
            ...mapGetters(
                [
                    'validationErrors',
                    'addBallTechnicianFormDisplayStatus',
                    'newBallTechnician',
                    'editBallTechnicianFormDisplayStatus',
                    'restoreBallTechniciansTableDisplayStatus'
                ]
            ),
        },
        methods:{
            ...mapActions(
                [
                    'createBallTechnician',
                    'showAddBallTechnicianForm',
                    'hideAddBallTechnicianForm'
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