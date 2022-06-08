<template>
    <div class="container-fluid">

        <button v-if="!editOperatorFormDisplayStatus && !restoreOperatorsTableDisplayStatus && !addOperatorFormDisplayStatus" class="btn btn-light btn-outline-secondary mt-4 mb-4" @click="showAddOperatorForm">Создать нового оператора</button>

        <form v-show="addOperatorFormDisplayStatus" class="form-horizontal form-width mt-4">

            <div class="row form-group">
                <label for="username" class="col-sm-3 control-label">Логин оператора</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.username" id="username"  placeholder="Operator username">
                    <span class="red-text" v-if="validationErrors.username" v-text="validationErrors.username[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_ru" class="col-sm-3 control-label">Имя оператора RU</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.name_ru" id="name_ru"  placeholder="Operator name RU">
                    <span class="red-text" v-if="validationErrors.name_ru" v-text="validationErrors.name_ru[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_lv" class="col-sm-3 control-label">Имя оператора LV</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.name_lv" id="name_lv"  placeholder="Operator name LV">
                    <span class="red-text" v-if="validationErrors.name_lv" v-text="validationErrors.name_lv[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="number" class="col-sm-3 control-label">Телефонный номер</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.number" id="number"  placeholder="Operator number">
                    <span class="red-text" v-if="validationErrors.number" v-text="validationErrors.number[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="studio_id" class="col-sm-3 control-label">Студия</label>
                <div class="col-sm">
                    <select id="studio_id" class="form-control form-control-sm" v-model="newOperator.studio_id">
                        <option v-for="studio in allStudiosForOperators" :value="studio.id">{{studio.name_ru}}</option>
                    </select>
                    <span class="red-text" v-if="validationErrors.studio_id" v-text="validationErrors.studio_id[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="password" class="col-sm-3 control-label">Пароль</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.password" id="password"  placeholder="Operator password">
                    <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="password_confirmation" class="col-sm-3 control-label">Повторите пароль</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.password_confirmation" id="password_confirmation"  placeholder="Operator password again">
                    <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="col-sm-10">
                    <button @click.prevent="createOperator(newOperator)" type="submit" class="btn btn-light btn-outline-secondary">Создать оператора</button>
                </div>
                <div class="col-sm-2">
                    <button @click.prevent="hideAddOperatorForm" type="submit" class="btn btn-light btn-outline-secondary pull-right">Отмена</button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "OperatorAddForm",
        computed:{
            ...mapGetters(
                [
                    'validationErrors',
                    'allStudiosForOperators',
                    'addOperatorFormDisplayStatus',
                    'newOperator',
                    'editOperatorFormDisplayStatus',
                    'restoreOperatorsTableDisplayStatus'
                ]
            ),
        },
        methods:{
            ...mapActions(
                [
                    'createOperator',
                    'showAddOperatorForm',
                    'hideAddOperatorForm'
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