<template>

    <div class="container-fluid mb-5 mt-5">
        <div class="row justify-content-center">

            <div v-if="!getOneEntryForTechSupport" class="text-center">
                <b-spinner label="Spinning"></b-spinner>
            </div>

            <div v-else-if="getOneEntryForTechSupport == 'no-entry'" class="text-center">
                <span>Такой записи не существует! </span>
            </div>

            <div v-else class="card">

                    <div class="card-header">
                        <span class="font-weight-bold">Студия:</span>
                        <span class="underline-text">
                            {{ (getOneEntryForTechSupport.studio && getOneEntryForTechSupport.studio.name_ru) ? getOneEntryForTechSupport.studio.name_ru : '-'}}
                        </span>
                    </div>

                    <div class="card-body">

                    <ul class="list-group list-group-flush">

                         <li class="list-group-item">
                            <span class="font-weight-bold">Тур:</span>
                            <small class="ml-3 text-muted">
                                {{ getOneEntryForTechSupport.tour ? getOneEntryForTechSupport.tour : '-' }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-bold">Дата:</span>
                            <small class="ml-3 text-muted">
                                {{ getOneEntryForTechSupport.occurred_at ? getOneEntryForTechSupport.occurred_at.substr(0, 10) : '-' }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-bold">Время:</span>
                            <small class="ml-3 text-muted">
                                {{ getOneEntryForTechSupport.occurred_at ? getOneEntryForTechSupport.occurred_at.substr(11) : '-' }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-bold">Оператор:</span>
                            <small class="ml-3 text-muted">
                                {{ ( getOneEntryForTechSupport.user && getOneEntryForTechSupport.user.operator && getOneEntryForTechSupport.user.operator.name_ru) ? getOneEntryForTechSupport.user.operator.name_ru : '-' }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-bold">Дежурный:</span>
                            <small class="ml-3 text-muted">
                                {{ ( getOneEntryForTechSupport.chef_id && getOneEntryForTechSupport.chef && getOneEntryForTechSupport.chef.name_ru ) ? getOneEntryForTechSupport.chef.name_ru : '-'}}
                            </small>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-bold">Тип события:</span>
                            <small class="ml-3 text-muted">
                                {{ ( getOneEntryForTechSupport.description_type_id && getOneEntryForTechSupport.type && getOneEntryForTechSupport.type.ru_name) ? getOneEntryForTechSupport.type.ru_name : '-'}}
                            </small>
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-bold">Описание:</span>
                            <small class="ml-3 text-muted">
                                {{ getOneEntryForTechSupport.description ? getOneEntryForTechSupport.description : '-'}}
                            </small>
                        </li>

                    </ul>

                </div>

            </div>

        </div>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "show_one_entry_for_tech_support",
        computed: {
            ...mapGetters(
                [
                    'getOneEntryForTechSupport',
                ]
            )
        },
        mounted (){
            this.fetchOneEntryForTechSupport();
        },
        methods:{
            ...mapActions(
                [
                    'fetchOneEntryForTechSupport',
                ]
            )
        }
    }
</script>

<style scoped>

    .card{
        margin-left:5%;
        margin-right:5%;
        max-width:500px;
        min-width:280px;
    }

    .underline-text{
        text-decoration:underline;
    }

</style>

