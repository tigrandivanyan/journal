<template>

    <div class="container-fluid mt-4">

        <button v-if="!addChefFormDisplayStatus && !editChefFormDisplayStatus" class="btn btn-light btn-outline-secondary" @click="switchRestoreChefTableDisplayStatus">{{formOpenerText}}</button>

        <div v-show="restoreChefTableDisplayStatus" class="table-wrapper">

            <div class="alert alert-success mb-4 mt-4" role="alert">
                Список всех удаленных дежурных
            </div>

            <div class="table-wrapper">
                <table v-if="allDeletedChefs.length > 0" class="table table-sm table-striped mt-4">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Chef ID</th>
                            <th>Логин</th>
                            <th>Имя RU</th>
                            <th>Имя LV</th>
                            <th>Телефонный номер</th>
                            <th>Восстановить</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for='chef in allDeletedChefs' :for="chef.id">
                            <th class="table-first-column-padding-15">{{chef.user ? chef.user.id : '-' }}</th>
                            <th>{{chef.id ? chef.id : '-' }}</th>
                            <td>{{chef.user ? chef.user.username : '-'}}</td>
                            <td>{{chef.name_ru ? chef.name_ru : '-'}}</td>
                            <td>{{chef.name_lv ? chef.name_lv : '-'}}</td>
                            <td>{{chef.number ? chef.number : '-'}}</td>
                            <td>
                                <a class="btn btn-default btn-xs" @click="restoreChef(chef.user.id)"><i class="fa fa-edit white"></i>Восстановить</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p v-else class="mt-5">Список удаленных дежурных пуст!</p>

            </div>
        </div>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "RestoreChefList",
        computed: {
            ...mapGetters(
                [
                    'allDeletedChefs',
                    'editChefFormDisplayStatus',
                    'addChefFormDisplayStatus',
                    'restoreChefTableDisplayStatus'
                ]
            ),
            formOpenerText(){
                return this.restoreChefTableDisplayStatus ? 'Скрыть таблицу': 'Восстановить дежурного';
            }
        },
        methods:{
            ...mapActions(
                [
                    'restoreChef',
                    'switchRestoreChefTableDisplayStatus'
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