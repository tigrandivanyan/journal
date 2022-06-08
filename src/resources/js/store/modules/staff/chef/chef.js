import axios from 'axios'

const state = {

    allChefs: [],
    allDeletedChefs: [],
    addChefFormDisplay:false,
    editChefFormDisplay:false,
    restoreChefTableDisplay:false,
    newChef: {
        id:'',
        username:'',
        name_ru:'',
        name_lv:'',
        number:'',
        password:'',
        password_confirmation:'',
    }

};

const getters = {

    newChef:(state) => state.newChef,
    allChefs:(state) => state.allChefs,
    allDeletedChefs:(state) => state.allDeletedChefs,
    addChefFormDisplayStatus:(state) => state.addChefFormDisplay,
    editChefFormDisplayStatus:(state) => state.editChefFormDisplay,
    restoreChefTableDisplayStatus:(state) => state.restoreChefTableDisplay,

};

const mutations = {

    setChefs: (state, chefs) => (state.allChefs = chefs),
    setDeletedChefs: (state, chefs) => (state.allDeletedChefs = chefs),

    showAddChefForm:(state) => (state.addChefFormDisplay = true),
    hideAddChefForm:(state) => (state.addChefFormDisplay = false),

    showEditChefForm:(state) => (state.editChefFormDisplay = true),
    hideEditChefForm:(state) => (state.editChefFormDisplay = false),

    hideRestoreChefTable:(state) => (state.restoreChefTableDisplay = false),
    switchRestoreChefTableDisplayStatus:(state) => (state.restoreChefTableDisplay = !state.restoreChefTableDisplay),

    setEditedChefData:(state, user) => (state. newChef = {
        id: user.id,
        username: user.username,
        name_ru: user.chef.name_ru,
        name_lv: user.chef.name_lv,
        number: user.chef.number,
    }),
    clearOldDataInNewChef:(state) => (state. newChef = {
        id:'',
        username:'',
        name_ru:'',
        name_lv:'',
        number:'',
        password:'',
        password_confirmation:'',
    })
};

const actions = {

    hideAddChefForm({commit}) { // represents Cancel button click in form
        commit('hideAddChefForm');
    },

    hideEditChefForm({commit}) { // represents Cancel button click in form
        commit('hideEditChefForm');
    },

    showAddChefForm({commit}) {   // represents addChef form Show button click
        commit('hideEditChefForm');
        commit('hideRestoreChefTable');
        commit('clearOldDataInNewChef');
        commit('clearValidationErrors');
        commit('showAddChefForm');
    },

    showEditChefForm({commit}, chef) { // represents editChef form Show button click
        commit('hideAddChefForm');
        commit('hideRestoreChefTable');
        commit('clearValidationErrors');
        commit('setEditedChefData', chef);
        commit('showEditChefForm');
    },

    switchRestoreChefTableDisplayStatus({commit, state, dispatch}) { // represents restoreChef table Show/Hide button click
        if(!state.restoreChefTableDisplay){ // load deleted operators when we open table with them
            commit('hideAddChefForm');
            commit('hideEditChefForm');

            dispatch('fetchDeletedChefs');
        }
        commit('switchRestoreChefTableDisplayStatus');
    },


    async fetchChefs({commit}) {

        const response = await axios.get(
            '/api/staff/chef/api_get_chefs'
        );

        commit('setChefs', response.data);
    },

    async fetchDeletedChefs({commit}) {

        const response = await axios.get(
            '/api/staff/chef/api_get_deleted_chefs'
        );

        commit('setDeletedChefs', response.data);
    },

    async createChef({commit, dispatch}, newChef) {

        axios.post('/api/staff/chef/api_save_new_chef', newChef)
            .then(function (response) {

                commit('hideAddChefForm');
                commit('clearValidationErrors');
                commit('clearOldDataInNewChef');

                dispatch('fetchChefs');
                dispatch('triggerModalNotification', 'Новая запись сохранена!');

            })
            .catch(function (error) {

                commit('clearValidationErrors');
                commit('validationErrors', error.response.data.errors);

                dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

            });

    },

    async saveChefChanges ({commit, dispatch}, newChef) {

        axios.post('/api/staff/chef/api_save_chef_changes', newChef)
            .then(function (response) {

                commit('hideEditChefForm');
                commit('clearValidationErrors');
                commit('clearOldDataInNewChef');

                dispatch('fetchChefs');
                dispatch('triggerModalNotification', 'Изменения сохранены!');

            })
            .catch(function (error) {

                commit('clearValidationErrors');
                commit('validationErrors', error.response.data);

                dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

            });
    },

    async restoreChef({dispatch}, user_id) {

        const response = await axios.post(
            '/api/staff/chef/api_restore_chef',
            {
                user_id,
            }
        ).then(function (response) {

            dispatch('fetchChefs');
            dispatch('fetchDeletedChefs');
            dispatch('triggerModalNotification', 'Дежурный восстановлен!');

        }).catch(function (error) {

            dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

        });
    },



    async deleteChef({commit, dispatch}, user_id) {

        const response = await axios.post(
            '/api/staff/chef/api_delete_chef',
            {
                user_id,
            }
        ).then(function (response) {

            commit('hideAddChefForm');
            commit('hideEditChefForm');

            dispatch('fetchChefs');
            dispatch('fetchDeletedChefs');
            dispatch('triggerModalNotification', 'Запись удалена!');

        }).catch(function (error) {

            dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

        });

    }

};



export default {
    state,
    getters,
    mutations,
    actions

}