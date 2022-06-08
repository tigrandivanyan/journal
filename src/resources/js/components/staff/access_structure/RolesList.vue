<template>

    <div class="container-fluid mb-4 mt-4">

        <div class="alert alert-success" role="alert">
            Роли, это основные блоки деления доступов в приложение. Не удаляйте их, если в этом нету крайней необходимости. Новые роли создаются автоматически в разделе "Назначенные роли", когда новая роль присваивается пользователю.
        </div>

        <table v-if="allRoles.length" class="table table-sm table-striped mt-4">
            <thead>
            <tr>
                <th style="padding-left:15px">ID</th>
                <th>Name</th>
                <th>Title</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for='role in allRoles' :for="role.id">
                <td scope="row" style="padding-left:20px">{{role.id}}</td>
                <td>{{!role.name ? '-' : role.name}}</td>
                <td>{{!role.title ? '-' : role.title}}</td>
                <td>
                    <button class="btn btn-light btn-outline-secondary btn-sm" @click="deleteRole(role.id)" data-toggle="modal" data-target="#modalInformationOnDelete"><i class="fas fa-times mr-2"></i>Delete</button>

                </td>
            </tr>
            </tbody>
        </table>
        <p v-else class="mt-5">Список ролей пуст!</p>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "Role",
        computed: {
            ...mapGetters(['allRoles']),
        },
        created(){
            this.fetchRoles();
        },
        methods:{
            ...mapActions(['fetchRoles', 'deleteRole']),
        }
    }


</script>

<style scoped>

</style>