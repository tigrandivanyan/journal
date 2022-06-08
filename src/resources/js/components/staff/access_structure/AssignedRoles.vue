<template>

    <div class="container-fluid mb-5 mt-4">

        <div class="alert alert-warning" role="alert">
            <p><strong>Legend. Roles </strong></p>

            <table v-if="allRolesForAssignedRoles.length" class="table table-striped table-sm legend-table-text-font">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for='role in allRolesForAssignedRoles' :for="role.id">
                        <td class="legend-table-column">{{role.id}}</td>
                        <td class="legend-table-column">{{!role.name ? '-' : role.name}}</td>
                        <td class="legend-table-column">{{!role.title ? '-' : role.title}}</td>
                    </tr>
                </tbody>
            </table>
            <p v-else class="mt-5">Список ролей пуст!</p>
        </div>

        <div class="alert alert-success" role="alert">
           Каждый пользователь может иметь несколько ролей!
        </div>

        <table v-if="allAssignedRoles.length" class="table table-sm table-striped mt-4">
            <thead>
                <tr>
                    <th>Role ID</th>
                    <th>Role Name</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='assignment in allAssignedRoles' :for="assignment.id">
                    <td class="table-column-padding-20">{{!assignment.role_id ? '-' : assignment.role_id}}</td>
                    <td
                        :class="[
                            {'light-red-text': assignment.role.id == 1},
                            {'light-blue-text': assignment.role.id == 2},
                            {'light-green-text': assignment.role.id == 3},
                            {'light-yellow-text': assignment.role.id == 4},
                            {'light-brown-text': assignment.role.id == 5},
                            {'light-grey-text': assignment.role.id == 6},
                        ]">
                    {{assignment.role ? assignment.role.title: 'Role has no title!'}}</td>
                    <td>{{!assignment.entity_id ? '-' : assignment.entity_id}}</td>
                    <td :class="{'light-red-text': !assignment.user}" >{{assignment.user ? assignment.user.username : 'User was deleted'}}</td>
                    <td>{{!assignment.entity_type ? '-' : assignment.entity_type}}</td>
                    <td><button type="button"  class="btn btn-sm padding button-padding-cutter" @click="deleteAssignedRole([assignment.role_id, assignment.entity_id])"><i  class="glyphicon glyphicon-trash"></i></button></td>
                </tr>
            </tbody>
        </table>

        <p v-else class="mt-5">Список назначенных ролей пуст!</p>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "AssignedRoles",
        computed: {
            ...mapGetters(
                [
                    'allAssignedRoles',
                    'allRolesForAssignedRoles'
                ]
            )
        },
        created(){
            this.fetchAssignedRoles();
            this.fetchRolesForAssignedRoles();
        },
        methods:{
            ...mapActions(
                [
                    'fetchAssignedRoles',
                    'fetchRolesForAssignedRoles',
                    'deleteAssignedRole'
                ]
            ),
        }
    }
</script>

<style scoped>

    .table-column-padding-20{
        padding-left:20px
    }

    .button-padding-cutter{
       padding:0 !important;
    }

    .legend-table-text-font{
        font-size:12px;
    }

    .legend-table-column{
        padding:1px 8px;
    }

    .light-red-text {
        color:#ef9e9e;
    }

    .light-blue-text {
        color: #0d51c2;
    }

    .light-green-text {
        color: #57c248;
    }

    .light-yellow-text {
        color: #ffaa00;
    }

    .light-brown-text {
        color: #c28f00;
    }

    .light-grey-text {
        color: #9d9e94;
    }
</style>