<template>


    <div class="list-group-item">
        <p class="m-3 text-primary nav-link entry-filter-event-type">По типу событий <small> ( доступен мультивыбор )</small></p>
        <form class="form-inline d-none entry-filter-event-type-container">
            <div class="form-group mx-sm-3 mb-2">
                <select class="form-control entry-filter-event-type-submit-select" name="event_type[]" id="studio-name" multiple>

                    <option v-for="entryType in getEntryTypesListForFiltering" value="">{{entryType.ru_name}}</option>

                </select>
            </div>
            <a  style="margin-left:20px" type="submit" href="" class="btn btn-primary entry-filter-event-type-submit-button mb-2">Отфильтровать</a>
        </form>
    </div>


</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "show_one_entry_for_tech_support",
        computed: {
            ...mapGetters(
                [
                    'getEntryTypesListForFiltering',
                ]
            )
        },
        created(){
            this.fetchEntryTypesListForFiltering();
        },
        methods:{
            ...mapActions(
                [
                    'fetchEntryTypesListForFiltering',
                ]
            )
        }
    }
</script>

<style scoped>

    .card{
        margin-left:20%;
        margin-right:20%;
    }

    .underline-text{
        text-decoration:underline;
    }

</style>

