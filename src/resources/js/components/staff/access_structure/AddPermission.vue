<template>
    <div class="container-fluid">
        <button v-show="!addPermissionFormDisplayStatus" class="btn btn-light btn-outline-secondary mt-4" @click="showAddPermissionForm">Назначить новые права</button>

        <form v-show="addPermissionFormDisplayStatus" class="form-horizontal mt-5 table-width">

            <div class="col-sm-offset-2 col-sm-10 mb-2 div-border-bottom">
                <div class="form-check">
                    <input @click="calculateInputStatusRoleUser('role')" class="form-check-input" type="radio" v-model="newPermission.radioRoleUserInput" value="permissionForRole" id="radioRoleInput">
                    <label class="form-check-label" for="radioRoleInput">
                        Permission for Role
                    </label>
                </div>
                <div class="form-check">
                    <input @click="calculateInputStatusRoleUser('user')" class="form-check-input" type="radio" v-model="newPermission.radioRoleUserInput" value="permissionForUser" id="radioUserInput">
                    <label class="form-check-label" for="radioUserInput">
                        Permission for User
                    </label>
                </div>
                <span class="red-text" v-if="validationErrors.radioRoleUserInput" v-text="validationErrors.radioRoleUserInput[0]"></span>
            </div>

            <div v-if="input_role_for_permission" class="form-group">
                <label for="role_id" class="col-sm-2 control-label">Role</label>
                <div class="col-sm-10">
                    <select class="form-control form-control-sm" v-model="newPermission.role_name" id="role_id">
                        <option v-for="role in allRolesForPermissions" :value="role.name">{{role.title}}</option>
                    </select>
                    <span class="red-text" v-if="validationErrors.role_name" v-text="validationErrors.role_name[0]"></span>
                </div>
            </div>

            <div v-if="input_user_for_permission" class="form-group">
                <label for="user_id" class="col-sm-2 control-label">User ID</label>
                <div class="col-sm-10">
                    <select @click="fetchUsersForPermissions" class="form-control form-control-sm" v-model="newPermission.user_id" id="user_id">
                        <option v-for="user in allUsersForPermissions" :value="user.id">{{user.username}} // ID: {{user.id}}</option>
                    </select>
                    <span class="red-text" v-if="validationErrors.user_id" v-text="validationErrors.user_id[0]"></span>
                </div>
            </div>

            <div class="col-sm-offset-2 col-sm-10 mb-2">
                <div class="form-check">
                    <input @click="calculateInputStatus('from_existing_abilities')" v-model="newPermission.existing_ability" value="true" class="form-check-input" type="radio" id="existingAbilityId">
                    <label class="form-check-label" for="existingAbilityId">
                        Choose ability from existing list
                    </label>
                </div>
                <div class="form-check">
                    <input @click="calculateInputStatus('new_ability')" v-model="newPermission.existing_ability" value="false" class="form-check-input" type="radio" id="newAbilityId">
                    <label class="form-check-label" for="newAbilityId">
                        Create new ability
                    </label>
                </div>
                <span class="red-text" v-if="validationErrors.existing_ability" v-text="validationErrors.existing_ability[0]"></span>
            </div>

            <div v-if="input_select_ability_status" class="form-group">
                <label for="ability_name" class="col-sm-2 control-label">Select Ability</label>
                <div class="col-sm-10">
                    <select class="form-control form-control-sm" v-model="newPermission.ability_name" id="ability_name">
                        <option v-for="ability in allAbilitiesForPermissions" @click="getInfo(ability)" :value="ability.id">{{ability.name}} // {{ability.studio ? ability.studio.name_eng : '-'}}</option>
                    </select>
                    <span class="red-text" v-if="validationErrors.ability_name" v-text="validationErrors.ability_name[0]"></span>
                </div>
            </div>

            <div v-if="input_new_ability_status" class="form-group">
                <label for="ability_new_name" class="col-sm-2 control-label">New Ability</label>
                <div class="col-sm-10">
                    <input class="form-control" v-model="newPermission.ability_name" id="ability_new_name" placeholder="New Ability name, use only lower case and separate words with dash">
                    <span class="red-text" v-if="validationErrors.ability_name" v-text="validationErrors.ability_name[0]" ></span>
                </div>
            </div>

            <div class="form-group">
                <label for="entity_type" class="col-sm-2 control-label">Entity Type</label>
                <div class="col-sm-10">
                    <input class="form-control" v-model="newPermission.entity_type" id="entity_type" placeholder="If you don't know what to put here, leave the space blank">
                    <span class="red-text" v-if="validationErrors.entity_type" v-text="validationErrors.entity_type[0]" ></span>
                </div>
            </div>

            <div class="form-group">
                <label for="entity_id" class="col-sm-2 control-label">Entity ID</label>
                <div class="col-sm-10">
                    <input class="form-control" v-model="newPermission.entity_id" id="entity_id" placeholder="If you don't know what to put here, leave the space blank">
                    <span class="red-text" v-if="validationErrors.entity_id" v-text="validationErrors.entity_type[0]" ></span>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="col-sm-offset-2 col-sm-8">
                    <button @click.prevent="createPermission(newPermission)" type="submit" class="btn btn-light btn-outline-secondary">Назначить</button>
                    <button @click.prevent="removePermission(newPermission)" type="submit" class="btn btn-light btn-outline-secondary">Удалить</button>
                    <button @click.prevent="makeAssociation(newPermission)" type="submit" class="btn btn-light btn-outline-secondary" :disabled="isDisabled" >Проассоциировать с моделью</button>
                </div>
                <div class="col-sm-2">
                    <button @click.prevent="hideAddPermissionForm" type="submit" class="btn btn-light btn-outline-secondary">Отмена</button>
                </div>
            </div>

        </form>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "AddPermission",
        data(){
          return{
              input_select_ability_status:false,
              input_new_ability_status:false,
              input_role_for_permission:false,
              input_user_for_permission:false,
          }
        },
        computed:{
            ...mapGetters(
                [
                    'validationErrors',
                    'addPermissionFormDisplayStatus',
                    'newPermission',
                    'allAbilitiesForPermissions',
                    'allUsersForPermissions',
                    'allRolesForPermissions'
                ]
            ),
            isDisabled(){
                return !this.newPermission.entity_type;
            }
        },
        created(){
           this.fetchAbilitiesForPermissions();
           this.fetchRolesForPermissions();
        },
        methods:{
            ...mapActions(
                [
                    'createPermission',
                    'showAddPermissionForm',
                    'hideAddPermissionForm',
                    'fetchAbilitiesForPermissions',
                    'fetchRolesForPermissions',
                    'fetchUsersForPermissions'
                ]
            ),
            getInfo(element){
                this.newPermission.ability_name = element.name;
                this.newPermission.entity_type = element.entity_type ? element.entity_type : '';
                this.newPermission.entity_id = element.entity_id ? element.entity_id : '';
            },
            removePermission(newPermission){
                this.newPermission.remove = true;
                this.createPermission(newPermission)
            },
            makeAssociation(newPermission){
                this.newPermission.own = true;
                this.createPermission(newPermission)
            },
            calculateInputStatus(value){
                if(value == 'from_existing_abilities'){
                    this.input_select_ability_status = true;
                    this.input_new_ability_status = true;
                }else if(value == 'new_ability'){
                    this.input_new_ability_status = true;
                    this.input_select_ability_status = false;
                }
            },
            calculateInputStatusRoleUser(value){
                if(value == 'role'){
                    this.input_role_for_permission = true;
                    this.input_user_for_permission = false;
                }else if(value == 'user'){
                    this.input_user_for_permission = true;
                    this.input_role_for_permission = false;
                }
            }
        }
    }
</script>

<style scoped>

    .table-width{
        max-width:1000px
    }

    .div-border-bottom{
        border-bottom: 1px solid lightgray;
    }

</style>