<template>

        <div class="modal fade" id="modalNotificationOnAdministratorRoleRetract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Действительно удалить роль Администратора у этого пользователя?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-outline-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" @click="retractAdministratorRoleFromUser(userIdForAdministratorRoleRetract)" data-dismiss="modal" class="btn btn-light btn-outline-secondary">Удалить</button>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>

    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "ModalNotificationOnAdministratorRoleRetract",
        computed: {
            ...mapGetters(['userIdForAdministratorRoleRetract'])
        },
        methods:{
            ...mapActions(['retractAdministratorRoleFromUser']),
        }
    }

</script>

<style scoped>

</style>