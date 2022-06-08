<template>


    <!--<div class="list-group-item">-->
        <!--<p class="m-3 text-primary nav-link entry-filter-time-interval">По временному интервалу</p>-->
        <!--<form class="form-inline d-none entry-filter-time-interval-container">-->
            <!--<div class="form-group mx-sm-3 mb-2">-->
                <!--<label class="mr-2" for="filterDateStart">От: </label>-->
                <!--<input style="padding-top:1px;" type="date" min="{{ $firstEntryDate }}" id="filterDateStart" class="form-control entry-filter-time-interval-start-input" placeholder="Номер комплекта">-->
            <!--</div>-->
            <!--<div class="form-group mx-sm-3 mb-2">-->
                <!--<label class="mr-2" for="filterDateEnd">До: </label>-->
                <!--<input style="padding-top:1px;" type="date" min="{{ $firstEntryDate }}"  id="filterDateEnd" class="form-control entry-filter-time-interval-end-input" placeholder="Номер комплекта">-->
            <!--</div>-->
            <!--<a  style="margin-left:20px" type="submit" href="/admin/entries/{{$studio}}?entry_filter_time_interval" class="btn btn-primary entry-filter-time-interval-submit-button mb-2">Отфильтровать</a>-->
        <!--</form>-->
    <!--</div>-->

</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "show_one_entry_for_tech_support",
        computed: {
            ...mapGetters(
                [
                    // 'getOneEntryForTechSupport',
                ]
            )
        },
        created(){
            // this.fetchOneEntryForTechSupport();
        },
        methods:{
            ...mapActions(
                [
                    // 'fetchOneEntryForTechSupport',
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

