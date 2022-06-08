<template>
    <div class="container-fluid">

        <button v-if="!addAssignedRoleFormDisplayStatus " class="btn btn-light btn-outline-secondary mt-4" @click="showAddAssignedRoleForm">Назначить\снять пользователю роль</button>

        <form v-show="addAssignedRoleFormDisplayStatus" class="form-horizontal form-width mt-4">

            <div class="row form-group">
                <label for="user_id" class="col-sm-2 control-label">User</label>
                <div class="col-sm">
                    <select id="user_id" class="form-control form-control-sm" v-model="newAssignedRole.user_id">
                        <option v-for="user in allUsersForAssignedRoles" :value="user.id">{{user.username}} // ID: {{user.id}}</option>
                    </select>
                    <span class="red-text" v-if="validationErrors.user_id" v-text="validationErrors.user_id[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-2 mr-4"></div>
                <div class="col-sm">
                    <input @click="roleInputType = !roleInputType" type="checkbox" class="form-check-input" id="checkboxForNewRole">
                    <label class="form-check-label" for="checkboxForNewRole">Create new Role</label>
                </div>
            </div>

            <div class="row form-group" v-if="!roleInputType">
                <label for="role_name" class="col-sm-2 control-label">Role</label>
                <div class="col-sm">
                    <select id="role_name" class="form-control form-control-sm" v-model="newAssignedRole.role_name">
                        <option v-for="role in allRolesForAssignedRoles" :value="role.name">{{role.title}}</option>
                    </select>
                    <span class="red-text" v-if="validationErrors.role_name" v-text="validationErrors.role_name[0]"></span>
                </div>
            </div>

            <div class="row form-group" v-if="roleInputType">
                <label for="new_role" class="col-sm-2 control-label">New Role</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newAssignedRole.role_name" id="new_role" placeholder="Use lowercase and separate the the words with dashes">
                    <span class="red-text" v-if="validationErrors.role_name" v-text="validationErrors.role_name[0]" ></span>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="col-sm-3 ">
                    <button @click.prevent="createAssignedRole(newAssignedRole)" type="submit" class="btn btn-light btn-outline-secondary">Назначить роль</button>
                </div>
                <div class="col-sm-3 m-0 p-0">
                    <button v-if="!roleInputType" @click.prevent="retractAssignedRole(newAssignedRole)" type="submit" class="btn btn-light btn-outline-secondary">Снять роль</button>
                </div>
                <div class="col-sm-2 offset-md-3">
                    <button @click.prevent="hideAddAssignedRoleForm" type="submit" class="btn btn-light btn-outline-secondary float-right">Отмена</button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "AddAssignedRole",
        data(){
            return{
                roleInputType: false,
            }
        },
        computed:{
            ...mapGetters(
                [
                    'validationErrors',
                    'addAssignedRoleFormDisplayStatus',
                    'newAssignedRole',
                    'allUsersForAssignedRoles',
                    'allRolesForAssignedRoles'
                ]
            ),
        },
        methods:{
            ...mapActions(
                [
                    'createAssignedRole',
                    'retractAssignedRole',
                    'showAddAssignedRoleForm',
                    'hideAddAssignedRoleForm'
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