import axios from 'axios'

const state = {
    oneEntryForTechSupport: '',
};

const getters = {
    getOneEntryForTechSupport:(state) => state.oneEntryForTechSupport,
};

const mutations = {
    setOneEntryForTechSupport: (state, retrievedEntryForTechSupport) => (state.oneEntryForTechSupport = retrievedEntryForTechSupport),
};

const actions = {

    fetchOneEntryForTechSupport({commit, dispatch}){

        let pathArray = window.location.pathname.split('/');

        axios.get('/api/api-show-one-entry/'+pathArray[2])
            .then(function (response) {

                if(response.data === "" || response.data === null ) {
                    commit('setOneEntryForTechSupport', 'no-entry');
                }else{
                    commit('setOneEntryForTechSupport', response.data);
                }
            })
            .catch(function (error) {
                dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');
            });
    }
};


export default {
    state,
    getters,
    actions,
    mutations
}