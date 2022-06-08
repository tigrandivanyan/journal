<template>
    <div class="container-fluid">

        <button
                v-if="!editStudioFormDisplayStatus && !addStudioFormDisplayStatus"
                type="button"
                class="btn btn-light btn-outline-secondary mt-4"
                @click="showAddStudioForm">
            Создать новую студию
        </button>

        <form v-show="addStudioFormDisplayStatus" class="form-horizontal form-width mt-4">

            <div class="row form-group">
                <label for="name_ru" class="col-sm-3">Название студии RU</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newStudio.name_ru" id="name_ru" placeholder="Studio name RU">
                    <span class="red-text" v-if="validationErrors.name_ru" v-text="validationErrors.name_ru[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_eng" class="col-sm-3 control-label">Название студии ENG</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newStudio.name_eng" id="name_eng" placeholder="Studio name ENG">
                    <span class="red-text" v-if="validationErrors.name_eng" v-text="validationErrors.name_eng[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-3 control-label">
                    <label for="order">Последовательность</label>
                    <i class="fas fa-info-circle"
                       title="Последовательность влияет на порядок отображения студий на главной странице журнала, а также на порядок отображения списка студий в архиве событий в администрационной панели">
                    </i>
                </div>
                <div class="col-sm">
                    <input class="form-control" v-model="newStudio.order" id="order" placeholder="Studio order" min="0">
                    <span class="red-text" v-if="validationErrors.order" v-text="validationErrors.order[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-3 control-label">
                    <label for="rng_id">Номер игры RNG-Hub</label>
                    <i class="fas fa-info-circle"
                       title="Номер должен соответствовать ID игры в RNG-Hub">
                    </i>
                </div>
                <div class="col-sm">
                    <input class="form-control" v-model="newStudio.rng_id" id="rng_id" placeholder="RNG-Hub game ID" min="0">
                    <span class="red-text" v-if="validationErrors.rng_id" v-text="validationErrors.rng_id[0]"></span>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="offset-md-3 col-sm-7">
                    <button
                        @click.prevent="createStudio(newStudio)"
                        type="submit"
                        class="btn btn-light btn-outline-secondary">
                        Создать студию
                    </button>
                </div>
                <div class="col-sm-2">
                    <button
                        @click.prevent="hideAddStudioForm"
                        type="submit"
                        class="btn btn-light btn-outline-secondary">
                        Отмена
                    </button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "StudioAddForm",
        computed:{
            ...mapGetters(
                [
                    'validationErrors',
                    'addStudioFormDisplayStatus',
                    'newStudio',
                    'editStudioFormDisplayStatus'
                ]
            ),
        },
        methods:{
            ...mapActions(
                [
                    'createStudio',
                    'showAddStudioForm',
                    'hideAddStudioForm',
                ]
            ),
        }
    }
</script>

<style scoped>

    .form-width{
        max-width:1000px;
    }

    button:hover{
        background: #5a6667;
    }
    .muted{
        color: grey;
    }


</style>