<template>
    <div v-show="editOperatorFormDisplayStatus" class="container-fluid">

        <div class="alert alert-info mb-4 mt-4">
            Редактировать оператора: <strong>{{newOperator.username}}</strong>
        </div>

        <form class="form-horizontal form-width mt-4">
            <input type="hidden" name="studio_id" v-model="newOperator.studio_id">

            <div class="row form-group">
                <label for="username" class="col-sm-3 control-label">Логин оператора</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.username" id="username" placeholder="Operator username">
                    <span class="red-text" v-if="validationErrors.username" v-text="validationErrors.username[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_ru" class="col-sm-3 control-label">Имя оператора RU</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.name_ru" id="name_ru" placeholder="Operator name RU">
                    <span class="red-text" v-if="validationErrors.name_ru" v-text="validationErrors.name_ru[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_lv" class="col-sm-3 control-label">Имя оператора LV</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.name_lv" id="name_lv" placeholder="Operator name LV">
                    <span class="red-text" v-if="validationErrors.name_lv" v-text="validationErrors.name_lv[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="number" class="col-sm-3 control-label">Телефонный номер</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.number" id="number" placeholder="Operator number">
                    <span class="red-text" v-if="validationErrors.number" v-text="validationErrors.number[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="studio_id_for_change" class="col-sm-3 control-label">Изменить студию</label>
                <div class="col-sm">
                    <select id="studio_id_for_change" class="form-control form-control-sm" v-model="newOperator.studio_id_for_change">
                        <option v-for="studio in allStudiosForOperators" :value="studio.id">{{studio.name_ru}}</option>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="password" class="col-sm-3 control-label">Пароль</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.password" id="password" placeholder="Operator password">
                    <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                    <span class="small">Заполнение поля "Пароль" и "Повторите пароль" не обязательно. Их следует заполнять, только если вы хотите сбросить пароль оператора.</span>
                </div>
            </div>

            <div class="row form-group">
                <label for="password_confirmation" class="col-sm-3 control-label">Повторите пароль</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newOperator.password_confirmation" id="password_confirmation" placeholder="Operator password again">
                    <span class="red-text" v-if="validationErrors.password" v-text="validationErrors.password[0]"></span>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="col-sm-offset-2 col-sm-8">
                    <button @click.prevent="saveOperatorChanges(newOperator)" type="submit" class="btn btn-light btn-outline-secondary">Сохранить изменения</button>
                </div>
                <div class="col-sm-2">
                    <button @click.prevent="hideEditOperatorForm" type="submit" class="btn btn-light btn-outline-secondary">Отмена</button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "OperatorEditForm",
        computed:{
            ...mapGetters(
                [
                    'validationErrors',
                    'allStudiosForOperators',
                    'editOperatorFormDisplayStatus',
                    'newOperator'
                ]
            ),
        },
        methods:{
            ...mapActions(
                [
                    'saveOperatorChanges',
                    'hideEditOperatorForm'
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