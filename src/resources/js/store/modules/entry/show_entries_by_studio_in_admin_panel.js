import axios from 'axios'

const state = {

    entryTypesListForFiltering: '',

};

const getters = {

    getEntryTypesListForFiltering:(state) => state.entryTypesListForFiltering,

};

const mutations = {

    setEntryTypesListForFiltering: (state, retrievedEntryTypesListForFiltering) => (state.entryTypesListForFiltering = retrievedEntryTypesListForFiltering),

};

const actions = {

    fetchEntryTypesListForFiltering({commit, dispatch}){

        var pathArray = window.location.pathname.split('/');

        axios.get('/api/api_entry_types_for_filtering/')
            .then(function (response) {
                console.log(response.data);
                // if(response.data === "" || response.data === null ) {
                //     dispatch('triggerModalNotification', 'Такой записи несуществует!');
                // }
                commit('setEntryTypesListForFiltering', response.data);
            })
            .catch(function (error) {
                dispatch('triggerModalNotification', 'Что-то пошло не так. Типы событий не подгрузились. Попробуйте снова!');
                console.log(error);
            });
    }


};


export default {
    state,
    getters,
    actions,
    mutations
}