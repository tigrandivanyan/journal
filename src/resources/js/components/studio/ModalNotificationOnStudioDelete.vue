<template>

        <div class="modal fade" id="modalInformationOnDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Действительно удалить?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-outline-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" @click="deleteStudio(studioIdOnDelete)" data-dismiss="modal" class="btn btn-primary">Удалить</button>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "ModalNotificationOnStudioDelete",
        computed: {
            ...mapGetters(['studioIdOnDelete'])
        },
        methods:{
            ...mapActions(['deleteStudio']),
        }
    }
</script>

<style scoped>

</style>