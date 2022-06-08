<template>
    <div class="container-fluid mb-5 mt-2">

        <h4>Выберите студию</h4>
        <div class="btn-group" role="group" v-for="studio in allStudiosForOperators">
            <button @click='selectStudio(studio.id)' class="btn btn-light btn-outline-secondary" :class="{ 'active': isActivated(studio.id) }" type="button">{{studio.name_ru}}</button>
        </div>

        <table v-if="allOperators.length" class="table table-sm table-striped mt-4">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Operator ID</th>
                    <th>Логин</th>
                    <th>Имя RU</th>
                    <th>Имя LV</th>
                    <th>Телефонный номер</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='user in allOperators' :for="user.id">
                    <td class="table-first-column-padding-15">{{user.id ? user.id : '-' }}</td>
                    <td>{{user.operator ? user.operator.id : '-' }}</td>
                    <td>{{user.username ? user.username : '-'}}</td>
                    <td>{{user.operator ? user.operator.name_ru : '-'}}</td>
                    <td>{{user.operator ? user.operator.name_lv : '-'}}</td>
                    <td>{{user.operator ? user.operator.number : '-'}}</td>
                    <td> <!-- edit button-->
                        <a class="btn btn-light btn-outline-secondary btn-sm" @click="showEditOperatorForm(user)"><i class="fa fa-edit white"></i>Edit</a>
                    </td>
                    <td>  <!-- delete button-->
                        <a class="btn btn-light btn-outline-secondary btn-sm" @click="deleteOperator([user.id, user.operator.studio_id])"><i class="fa fa-times white"></i> Delete </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <p v-else class="mt-5"> Студия не выбрана или в этой студии нету ни одного оператора</p>

    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "OperatorList",
        data(){
            return{
                activeMenuItem: ''
            }
        },
        computed: {
            ...mapGetters(
                [
                    'allOperators',
                    'allStudiosForOperators'
                ]
            ),
        },
        created(){
            this.fetchStudiosForOperators();
        },
        methods:{
            isActivated(menuItem) {
                return this.activeMenuItem === menuItem
            },
            selectStudio(studio_id){
                this.activeMenuItem = studio_id;
                this.fetchOperators(studio_id);
            },
            ...mapActions(
                [
                    'fetchStudiosForOperators',
                    'fetchOperators',
                    'showEditOperatorForm',
                    'deleteOperator'
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