<template>
    <div class="container-fluid">

        <button v-if="!addAdministratorFormDisplayStatus"
                class="btn btn-light btn-outline-secondary mt-4 mb-4"
                @click="showAddNewAdministratorForm">
            Создать нового администратора
        </button>

        <div class="d-flex justify-content-center">

            <form v-show="addAdministratorFormDisplayStatus" class="form-horizontal form-width mt-4 float-center" >

                <div class="alert alert-success" role="alert">
                    Это форма предназначена для создания нового пользователя с правами администратора.
                    Если пользователь уже зарегистрирован в системе,
                    и вы хотите ему назначить права администратора,
                    то делайте это через раздел "Назначенные роли".
                </div>

                <div class="row form-group">
                    <label for="username" class="col-sm-3 control-label">Логин оператора</label>
                    <div class="col-sm">
                        <input class="form-control" v-model="newAdministrator.username" id="username" placeholder="Administrator username">
                        <span class="red-text" v-if="validationErrors.username" v-text="validationErrors.username[0]"></span>
                    </div>
                </div>

                <div class="row form-group">
                    <label for="password" class="col-sm-3 control-label">Пароль</label>
                    <div class="col-sm">
                        <input class="form-control" v-model="newAdministrator.password" id="password"  placeholder="Administrator password">
                        <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                    </div>
                </div>

                <div class="row form-group">
                    <label for="password_confirmation" class="col-sm-3 control-label">Повторите пароль</label>
                    <div class="col-sm">
                        <input class="form-control" v-model="newAdministrator.password_confirmation" id="password_confirmation"  placeholder="Administrator password again">
                        <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                    </div>
                </div>

                <div class="row form-group mt-5">
                    <div class="col-sm-10">
                        <button @click.prevent="createAdministrator(newAdministrator)"
                                type="submit"
                                class="btn btn-light btn-outline-secondary">
                            Создать администратора
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button @click.prevent="hideAddAdministratorForm"
                                type="submit"
                                class="btn btn-light btn-outline-secondary pull-right">
                            Отмена
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>

</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "AdministratorAddForm",
        computed:{
            ...mapGetters(
                [
                    'validationErrors',
                    'addAdministratorFormDisplayStatus',
                    'newAdministrator',
                ]
            ),
        },
        methods:{
            ...mapActions(
                [
                    'showAddNewAdministratorForm',
                    'hideAddAdministratorForm',
                    'createAdministrator',
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