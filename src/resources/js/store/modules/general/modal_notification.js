
const state = {
    modalNotificationText:'',
};

const getters = {

    modalNotificationText:(state) => state.modalNotificationText,

};

const actions = {

    triggerModalNotification({commit}, modalText) {
        commit('updateModalNotificationText', modalText);

        $(document).ready(function(){
            $('#triggerModalInformation').trigger('click');
        });

    },

};

const mutations = {

    updateModalNotificationText:(state, notificationText) => (state.modalNotificationText = notificationText)

};

export default {
    state,
    getters,
    actions,
    mutations
}