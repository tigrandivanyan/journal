<template>
    <div class="container-fluid mb-5 mt-2">

        <table class="table table-sm table-striped mt-4">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Логин</th>
                    <th class="float-right mr-4">Удалить права администратора</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='user in allUsersForAdministrator' :for="user.id">
                    <td class="pl-5">{{user.id ? user.id : '-' }}</td>
                    <td>{{user.username ? user.username : '-'}}</td>
                    <td>  <!-- delete admin role button-->
                        <button class="btn btn-light btn-outline-secondary btn-sm float-right mr-4"
                                @click="setUserIdForAdministratorRoleRetract(user.id)"
                                data-toggle="modal"
                                data-target="#modalNotificationOnAdministratorRoleRetract">
                            <i class="fas fa-times mr-2"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "AdministratorList",
        data(){
            return{
            }
        },
        computed: {
            ...mapGetters(
                [
                    'allUsersForAdministrator',
                ]
            ),
        },
        created(){
            this.fetchUsersForAdministrator();
        },
        methods:{
            ...mapActions(
                [
                    'fetchUsersForAdministrator',
                    'setUserIdForAdministratorRoleRetract'
                ]
            )
        }
    }
</script>

<style scoped>

    thead{
        border-top:1px solid lightgrey;
    }

</style>