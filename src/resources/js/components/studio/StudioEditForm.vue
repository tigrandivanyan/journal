<template>
    <div v-show="editStudioFormDisplayStatus" class="container-fluid">

        <div class="alert alert-info mb-4 mt-4">
            Редактируем студию: <strong>{{newStudio.name_ru}}</strong>
        </div>

        <form class="form-horizontal form-width mt-4">
            <input type="hidden"  name="id"  v-model="newStudio.id">

            <div class="row form-group">
                <label for="name_ru" class="col-sm-3 control-label">Название студии RU</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newStudio.name_ru" id="name_ru"  placeholder="Studio name_ru">
                    <span class="red-text" v-if="validationErrors.name_ru" v-text="validationErrors.name_ru[0]"></span>
                </div>
            </div>

            <div class="row form-group">
                <label for="name_eng" class="col-sm-3 control-label">Название студии ENG</label>
                <div class="col-sm">
                    <input class="form-control" v-model="newStudio.name_eng" id="name_eng"  placeholder="Studio name_eng">
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
                    <input type="number" class="form-control" v-model="newStudio.order" id="order"  placeholder="Studio order">
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
                    <input type="number" class="form-control" v-model="newStudio.rng_id" id="rng_id"  placeholder="RNG-Hub game ID">
                    <span class="red-text" v-if="validationErrors.rng_id" v-text="validationErrors.rng_id[0]"></span>
                </div>
            </div>

            <div class="row form-group mt-5">
                <div class="offset-md-3 col-sm-7">
                    <button @click.prevent="saveStudioChanges(newStudio)" type="submit" class="btn btn-light btn-outline-secondary">Сохранить изменения</button>
                </div>
                <div class="col-sm-2">
                    <button @click.prevent="hideEditStudioForm" type="submit" class="btn btn-light btn-outline-secondary">Отмена</button>
                </div>
            </div>
    
        </form>

    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "StudioEditForm",
        computed:{
            ...mapGetters(
                [
                    'validationErrors',
                    'editStudioFormDisplayStatus',
                    'newStudio'
                ]
            ),
        },
        methods:{
            ...mapActions(
                [
                    'saveStudioChanges',
                    'hideEditStudioForm'
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