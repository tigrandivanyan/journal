<template>

    <div class="container-fluid mt-4">

        <button v-if="!editOperatorFormDisplayStatus && !addOperatorFormDisplayStatus" class="btn btn-light btn-outline-secondary" @click="switchRestoreOperatorsTableDisplayStatus">{{formOpenerText}}</button>

        <div v-show="restoreOperatorsTableDisplayStatus" class="table-wrapper">

            <div class="alert alert-success mt-4" role="alert">
                Список всех удаленных операторов
            </div>

            <div class="table-wrapper">
                <table v-if="allDeletedOperators.length" class="table table-sm table-striped mt-4">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Operator ID</th>
                            <th>Логин</th>
                            <th>Имя RU</th>
                            <th>Имя LV</th>
                            <th>Телефонный номер</th>
                            <th>Студия</th>
                            <th>Восстановить</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for='operator in allDeletedOperators' :for="operator.id">
                            <td class="table-first-column-padding-15">{{operator.user ? operator.user.id : '-'}}</td>
                            <td>{{operator.id ? operator.id : '-' }}</td>
                            <td>{{operator.user ? operator.user.username : '-'}}</td>
                            <td>{{operator.name_ru ? operator.name_ru : '-'}}</td>
                            <td>{{operator.name_lv ? operator.name_lv : '-'}}</td>
                            <td>{{operator.number ? operator.number : '-'}}</td>
                            <td>{{operator.studio_id ? operator.studio.name_ru : '-'}}</td>
                            <td>
                                <button class="btn btn-light btn-outline-secondary btn-sm" @click="restoreOperator([operator.user.id, operator.studio_id])"><i class="fa fa-edit white"></i>Восстановить</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p v-else class="mt-5">Список удаленных операторов пуст!</p>
            </div>
        </div>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "RestoreOperatorList",
        computed: {
            ...mapGetters(
                [
                    'allDeletedOperators',
                    'editOperatorFormDisplayStatus',
                    'addOperatorFormDisplayStatus',
                    'restoreOperatorsTableDisplayStatus'
                ]
            ),
            formOpenerText(){
                return this.restoreOperatorsTableDisplayStatus ? 'Скрыть таблицу': 'Восстановить оператора';
            }
        },
        methods:{
            ...mapActions(
                [
                    'restoreOperator',
                    'switchRestoreOperatorsTableDisplayStatus'
                ]
            )
        }
    }
</script>

<style scoped>

    .table-first-column-padding-15{
        padding-left:15px
    }

</style>