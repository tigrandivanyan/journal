<template>
    <div class="container-fluid mt-4">

        <button
            v-if="!editBallTechnicianFormDisplayStatus && !addBallTechnicianFormDisplayStatus"
            class="btn btn-light btn-outline-secondary"
            @click="switchRestoreBallTechniciansTableDisplayStatus">
            {{formOpenerText}}
        </button>

        <div v-show="restoreBallTechniciansTableDisplayStatus" class="table-wrapper">

            <div class="alert alert-info mb-4 mt-4">
                Список всех удаленных техников по шарам
            </div>

            <table v-if="allDeletedBallTechnicians.length" class="table table-striped mb-0 mt-3">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Ball technician ID</th>
                        <th>Логин</th>
                        <th>Имя RU</th>
                        <th>Имя LV</th>
                        <th>Телефонный номер</th>
                        <th>Восстановить</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for='ballTechnician in allDeletedBallTechnicians' :for="ballTechnician.id">
                        <td class="table-first-column-padding-15">{{ballTechnician.user ? ballTechnician.user.id : '-'}}</td>
                        <td>{{ballTechnician.id ? ballTechnician.id : '-' }}</td>
                        <td>{{ballTechnician.user ? ballTechnician.user.username : '-'}}</td>
                        <td>{{ballTechnician.name_ru ? ballTechnician.name_ru : '-'}}</td>
                        <td>{{ballTechnician.name_lv ? ballTechnician.name_lv : '-'}}</td>
                        <td>{{ballTechnician.number ? ballTechnician.number : '-'}}</td>
                        <td> <!-- edit button-->
                            <a class="btn btn-default btn-xs" @click="restoreBallTechnician(ballTechnician.user.id)"><i class="fa fa-edit white"></i>Восстановить</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p v-else class="mt-5">Список удаленных техников по шарам пуст!</p>

        </div>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "RestoreBallTechnicianList",
        computed: {
            ...mapGetters(
                [
                    'allDeletedBallTechnicians',
                    'editBallTechnicianFormDisplayStatus',
                    'addBallTechnicianFormDisplayStatus',
                    'restoreBallTechniciansTableDisplayStatus'
                ]
            ),
            formOpenerText(){
                return this.restoreBallTechniciansTableDisplayStatus ? 'Скрыть таблицу' : 'Восстановить техника по шарам';
            }
        },
        methods:{
            ...mapActions(
                [
                    'restoreBallTechnician',
                    'switchRestoreBallTechniciansTableDisplayStatus'
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