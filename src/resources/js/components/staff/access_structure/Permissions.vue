<template>

    <div class="container-fluid mb-5 mt-5">

        <div class="alert alert-warning" role="alert">
            <p><strong>Legend. Abilities </strong></p>

            <table v-if="allAbilitiesForPermissions.length" class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Studio_ID</th>
                        <th>Studio_Name</th>
                        <th>Entity_Type</th>
                        <th>Only_Owned</th>
                        <th>Scope</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for='ability in allAbilitiesForPermissions' :for="ability.id" style="padding:0">
                        <td class="legend-table-column" style="">{{ability.id}}</td>
                        <td class="legend-table-column">{{!ability.name ? '-' : ability.name}}</td>
                        <td class="legend-table-column">{{!ability.title ? '-' : ability.title}}</td>
                        <td class="legend-table-column">{{!ability.entity_id ? '-' : ability.entity_id}}</td>
                        <td class="legend-table-column">{{!ability.studio ? '-' : ability.studio.name_eng}}</td>
                        <td class="legend-table-column">{{!ability.entity_type ? '-' : ability.entity_type}}</td>
                        <td class="legend-table-column">{{!ability.only_owned ? '-' : ability.only_owned}}</td>
                        <td class="legend-table-column">{{!ability.scope ? '-' : ability.scope}}</td>
                    </tr>
                </tbody>
            </table>
            <p v-else class="mt-5">Список прав пуст!</p>
        </div>

        <table v-if="allPermissions.length" class="table table-sm table-striped mt-4">
            <thead>
                <tr>
                    <th>Ability_ID</th>
                    <th>Ability_Title</th>
                    <th>Entity_ID (User_ID)</th>
                    <th>User_Name</th>
                    <th>Entity_Type</th>
                    <th>Forbidden</th>
                    <th>Scope</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='permission in allPermissions' :for="permission.id">
                    <td>{{!permission.ability_id ? '-' : permission.ability_id}}</td>
                    <td>{{!permission.ability ? '-' : permission.ability.title}}</td>
                    <td>{{!permission.entity_id ? '-' : permission.entity_id}}</td>
                    <td>{{permission.user ? permission.user.username : '-'}}</td>
                    <td>{{!permission.entity_type ? '-' : permission.entity_type}}</td>
                    <td>{{!permission.forbidden ? '-' : permission.forbidden}}</td>
                    <td>{{!permission.scope ? '-' : permission.scope}}</td>
                    <td><button type="button" style="padding:0 !important" class="btn btn-sm" @click="deletePermission([permission.ability_id, permission.entity_id])"><i  class="glyphicon glyphicon-trash"></i></button></td>
                </tr>
            </tbody>
        </table>
        <p v-else class="mt-5">Список назначенных прав пуст!</p>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "AssignedRoles",
        computed: {
            ...mapGetters(
                [
                    'allPermissions',
                    'allAbilitiesForPermissions'
                ]
            )
        },
        created(){
            this.fetchPermissions();
            this.fetchAbilitiesForPermissions();
            this.fetchUsersForPermissions();
        },
        methods:{
            ...mapActions(
                [
                    'fetchPermissions',
                    'fetchAbilitiesForPermissions',
                    'fetchUsersForPermissions',
                    'deletePermission'
                ]
            ),
        }
    }
</script>

<style scoped>

    .legend-table-column{
        padding:1px 8px;
        font-size:12px
    }

</style>