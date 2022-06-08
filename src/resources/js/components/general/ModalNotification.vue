<template>
    <div class="modal-notification-wrapper">

        <!-- modal window for notifications -->
        <button id="triggerModalInformation" type="button" class="btn btn-small p-0 hidden" data-toggle="modal" data-target="#modalInformation"></button>
        <div class="modal fade" id="modalInformation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        {{modalNotificationText}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import { mapGetters } from 'vuex'

    export default {
        name: "ModalNotification",
        computed: {
            ...mapGetters(['modalNotificationText'])
        }
    }
</script>

<style scoped>

    .modal-notification-wrapper, button{
        height:1px;
    }

</style>