<template>

    <div class="container-fluid mb-4 mt-4">

        <div class="alert alert-warning" role="alert">
            <p><strong>Legend. Studios ID's </strong></p>

            <table v-if="allStudiosForAbilities.length" class="table table-striped table-sm legend-table-text-font">
                <thead>
                    <tr>
                        <th>Studio ID</th>
                        <th>Studio Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for='studio in allStudiosForAbilities' :for="studio.id">
                        <td class="legend-table-column">{{studio.id}}</td>
                        <td class="legend-table-column">{{!studio.name_ru ? '-' : studio.name_ru}}</td>
                    </tr>
                </tbody>
            </table>
            <p v-else class="mt-5">Список студий пуст!</p>
        </div>


        <table v-if="allAbilities.length" class="table table-sm table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Studio ID</th>
                    <th>Studio Name</th>
                    <th>Only Owned</th>
                    <th>Scope</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='(ability, key) in allAbilities' :for="ability.id">
                    <td>{{!ability.id ? '-' : ability.id}}</td>
                    <td>{{!ability.name ? '-' : ability.name}}</td>
                    <td>{{!ability.title ? '-' : ability.title}}</td>
                    <td>{{!ability.entity_id ? '-' : ability.entity_id}}</td>
                    <td>{{!ability.studio ? '-' : ability.studio.name_eng}}</td>
                    <td>{{!ability.only_owned ? '-' : ability.only_owned}}</td>
                    <td>{{!ability.scope ? '-' : ability.scope}}</td>
                    <td>
                        <button class="btn btn-light btn-outline-secondary btn-sm" @click="deleteAbility(ability.id)"><i class="fas fa-times mr-2"></i>Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <p v-else class="mt-5">Список прав пуст!</p>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "Abilities",
        computed: {
            ...mapGetters(
                [
                    'allAbilities',
                    'allStudiosForAbilities'
                ]
            )
        },
        created(){
            this.fetchAbilities();
            this.fetchStudiosForAbilities();
        },
        methods:{
            ...mapActions(
                [
                    'fetchAbilities',
                    'fetchStudiosForAbilities',
                    'deleteAbility'
                ]
            )
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