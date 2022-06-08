<template>

    <div class="container-fluid mb-5 mt-5">

        <table v-if="allBallTechnicians.length"  class="table table-sm table-striped mt-4">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Ball technician ID</th>
                    <th>Логин</th>
                    <th>Имя RU</th>
                    <th>Имя LV</th>
                    <th>Телефонный номер</th>
                    <th>Админ журнала по шарам</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='user in allBallTechnicians' :for="user.id">
                    <td class="table-first-column-padding-15">{{user.id ? user.id : '-' }}</td>
                    <td>{{user.ball_technician ? user.ball_technician.id : '-' }}</td>
                    <td>{{user.username ? user.username : '-'}}</td>
                    <td>{{user.ball_technician ? user.ball_technician.name_ru : '-'}}</td>
                    <td>{{user.ball_technician ? user.ball_technician.name_lv : '-'}}</td>
                    <td>{{user.ball_technician ? user.ball_technician.number : '-'}}</td>
                    <td>{{user.ball_technician ? user.ball_technician.ball_tech_admin : '-'}}</td>
                    <td> <!-- edit button-->
                        <a
                            class="btn btn-light btn-outline-secondary btn-sm"
                            @click="showEditBallTechnicianForm(user)">
                                <i class="fa fa-edit white"></i>
                            Edit
                        </a>
                    </td>
                    <td>  <!-- delete button-->
                        <a
                            class="btn btn-light btn-outline-secondary btn-sm"
                            @click="deleteBallTechnician(user.id)">
                                <i class="fa fa-times white"></i>
                            Delete
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <p v-else class="mt-5">Список техников по шарам пуст!</p>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "BallTechnicianList",
        computed: {
            ...mapGetters(['allBallTechnicians'])
        },
        created(){
            this.fetchBallTechnicians();
        },
        methods:{
            ...mapActions(
                [
                    'fetchBallTechnicians',
                    'showEditBallTechnicianForm',
                    'deleteBallTechnician'
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