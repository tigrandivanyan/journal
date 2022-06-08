import axios from 'axios'

const state = {
        emel: '55'
    // allStudios: [],
    // studioIdOnDelete:'',
    // newStudioFormDisplay:false,
    // editStudioFormDisplay:false,
    // newStudio: {
    //     id:'',
    //     name_ru:'',
    //     name_eng:'',
    //     order:''
    // }
};

const getters = {


    emel:(state) => state.emel,
    // newStudio:(state) => state.newStudio,
    // allStudios:(state) => state.allStudios,
    // studioIdOnDelete:(state) => state.studioIdOnDelete,
    // addStudioFormDisplayStatus:(state) => state.newStudioFormDisplay,
    // editStudioFormDisplayStatus:(state) => state.editStudioFormDisplay,

};

const mutations = {

    // setStudios: (state, studios) => (state.allStudios = studios),
    // setStudioIdOnDelete: (state, studioIdOnDelete) => (state.studioIdOnDelete = studioIdOnDelete),
    //
    // showAddStudioForm:(state) => (state.newStudioFormDisplay = true),
    // hideAddStudioForm:(state) => (state.newStudioFormDisplay = false),
    //
    // hideEditStudioForm:(state) => (state.editStudioFormDisplay = false),
    // showEditStudioForm:(state) => (state.editStudioFormDisplay = true),
    //
    // setEditedStudioData:(state, studio) => (state. newStudio = {
    //     id: studio.id,
    //     name_ru: studio.name_ru,
    //     name_eng: studio.name_eng,
    //     order: studio.order,
    // }),
    // clearOldDataInNewStudio:(state) => (state. newStudio = {
    //     id:'',
    //     name_ru:'',
    //     name_eng:'',
    //     order:''
    // })
};

const actions = {

    // setStudioIdOnDelete({commit}, studio_id) { // we set studio Id, because we have confirmation window on delete button, not like in other parts of admin panel
    //     commit('setStudioIdOnDelete', studio_id);
    // },
    //
    // hideAddStudioForm({commit}) { // represents Cancel button click in form
    //     commit('hideAddStudioForm');
    // },
    //
    // hideEditStudioForm({commit}) { // represents Cancel button click in form
    //     commit('hideEditStudioForm');
    // },
    //
    // showAddStudioForm({commit}) {  // represents addStudio form Show button click
    //     commit('hideEditStudioForm');
    //     commit('clearOldDataInNewStudio');
    //     commit('clearValidationErrors');
    //     commit('showAddStudioForm');
    // },
    //
    // showEditStudioForm({commit}, studio) { // represents editStudio form Show button click
    //     commit('hideAddStudioForm');
    //     commit('clearOldDataInNewStudio');
    //     commit('clearValidationErrors');
    //     commit('setEditedStudioData', studio);
    //     commit('showEditStudioForm');
    // },
    //
    //
    // testApi() {
    //     axios.get('https://rng-hub2.staging.rng:8001/rng/3/')
    //     .then(function (response) {
    //         // handle success
    //         console.log(response);
    //     })
    //     .catch(function (error) {
    //         // handle error
    //         console.log(error);
    //     })
    //     .finally(function () {
    //         // always executed
    //     });
    //
    // },
    //
    //
    // //
    // // async
    // //
    // //     axios.get('https://rng-hub2.staging.rng:8001/rng/3/').then(function (response) {
    // //
    // //             window.console.log(response);
    // //
    // //
    // //     }).catch(function (error) {
    // //
    // //         window.console.log("error apeear");
    // //         window.console.log(error);
    // //
    // //     });
    // //     window.console.log(55);
    // //
    // //
    // //     // commit('setStudios', response.data);
    // // },
    //
    //
    // async fetchStudios({commit}) {
    //
    //     const response = await axios.get(
    //         '/api/studio/api_get_studios'
    //     );
    //
    //     commit('setStudios', response.data);
    // },
    //
    //
    //
    // async createStudio({commit, dispatch}, newStudio) {
    //
    //     axios.post('/api/studio/api_save_new_studio', newStudio)
    //         .then(function (response) {
    //
    //             commit('hideAddStudioForm');
    //             commit('clearValidationErrors');
    //             commit('clearOldDataInNewStudio');
    //
    //             dispatch('fetchStudios');
    //             dispatch('triggerModalNotification', 'Новая запись сохранена!');
    //
    //
    //         }).catch(function (error) {
    //
    //             commit('clearValidationErrors');
    //             commit('validationErrors', error.response.data);
    //
    //             dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');
    //
    //
    //     });
    //
    // },
    //
    // async saveStudioChanges ({commit, dispatch}, newStudio) {
    //
    //     axios.post('/api/studio/api_save_studio_changes', newStudio)
    //         .then(function (response) {
    //
    //             commit('hideEditStudioForm');
    //             commit('clearValidationErrors');
    //             commit('clearOldDataInNewStudio');
    //
    //             dispatch('fetchStudios');
    //             dispatch('triggerModalNotification', 'Изменения сохранены!');
    //
    //
    //         }).catch(function (error) {
    //
    //             commit('clearValidationErrors');
    //             commit('validationErrors', error.response.data);
    //
    //             dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');
    //
    //
    //     });
    // },
    //
    //
    //
    // async deleteStudio({commit, dispatch}, studio_id) {
    //
    //     const response = await axios.post(
    //         '/api/studio/api_delete_studio',
    //         {
    //             studio_id,
    //         }
    //     ).then(function (response) {
    //
    //         commit('hideEditStudioForm');
    //         commit('hideAddStudioForm');
    //
    //         dispatch('fetchStudios');
    //         dispatch('triggerModalNotification', 'Запись удалена!');
    //
    //
    //     }).catch(function (error) {
    //
    //         dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');
    //
    //     });
    // },
};


export default {
    state,
    getters,
    actions,
    mutations
}