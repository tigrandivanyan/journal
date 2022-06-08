<template>
    <div class="container-fluid mt-2">

        <table v-if="allStudios.length" class="table table-sm table-striped mt-4">
            <thead>
                <tr>
                    <th>ID Студии</th>
                    <th>Имя RU</th>
                    <th>Имя ENG</th>
                    <th>RNG_id
                        <i class="fas fa-info-circle"
                           title="Номер соответствует ID игры в RNG-Hub">
                        </i>
                    </th>
                    <th>Последовательность
                        <i class="fas fa-info-circle"
                           title="Последовательность влияет на порядок отображения студий на главной странице журнала, а также на порядок отображения списка студий в архиве событий в администрационной панели">
                        </i>
                    </th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='studio in allStudios' :for="studio.id">
                    <td class="table-first-column-padding-15" >{{studio.id ? studio.id : '-' }}</td>
                    <td>{{studio.name_ru ? studio.name_ru : '-'}}</td>
                    <td>{{studio.name_eng ? studio.name_eng : '-'}}</td>
                    <td>{{studio.rng_id ? studio.rng_id : '-'}}</td>
                    <td>{{studio.order ? studio.order : '-'}}</td>
                    <td> <!-- edit button-->
                        <button class="btn btn-light btn-outline-secondary btn-sm"
                                @click="showEditStudioForm(studio)">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                        </button>
                    </td>
                    <td>  <!-- delete button-->
                        <button class="btn btn-light btn-outline-secondary btn-sm"
                                @click="setStudioIdOnDelete(studio.id)"
                                data-toggle="modal"
                                data-target="#modalInformationOnDelete">
                            <i class="fas fa-times mr-2"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <p v-else class="mt-5">Список студий пуст!</p>

    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "StudioList",
        computed: {
            ...mapGetters(['allStudios']),
        },
        created(){
            this.fetchStudios();
        },
        methods:{
            ...mapActions(
                [
                    'fetchStudios',
                    'showEditStudioForm',
                    'setStudioIdOnDelete'
                ]
            ),
        }
    }
</script>

<style scoped>
    
    .table-first-column-padding-15{
        padding-left:15px
    }
    
</style>