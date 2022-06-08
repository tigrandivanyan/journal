<template>

    <div class="container-fluid mb-5 mt-2">

        <table v-if="allChefs.length" class="table table-sm table-striped mt-4">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Chef ID</th>
                    <th>Логин</th>
                    <th>Имя RU</th>
                    <th>Имя LV</th>
                    <th>Телефонный номер</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='user in allChefs' :for="user.id">
                    <td class="table-first-column-padding-15">{{user.id ? user.id : '-' }}</td>
                    <td>{{user.chef ? user.chef.id : '-' }}</td>
                    <td>{{user.username ? user.username : '-'}}</td>
                    <td>{{user.chef ? user.chef.name_ru : '-'}}</td>
                    <td>{{user.chef ? user.chef.name_lv : '-'}}</td>
                    <td>{{user.chef ? user.chef.number : '-'}}</td>
                    <td> <!-- edit button-->
                        <a class="btn btn-light btn-outline-secondary btn-sm" @click="showEditChefForm(user)"><i class="fa fa-edit white"></i>Edit</a>
                    </td>
                    <td>  <!-- delete button-->
                        <a class="btn btn-light btn-outline-secondary btn-sm" @click="deleteChef(user.id)"><i class="fa fa-times white"></i> Delete </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <p v-else class="mt-5">Список дежурных пуст!</p>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "ChefList",
        computed: {
            ...mapGetters(['allChefs'])
        },
        created(){
            this.fetchChefs();
        },
        methods:{
            ...mapActions(
                [
                    'fetchChefs',
                    'showEditChefForm',
                    'deleteChef'
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