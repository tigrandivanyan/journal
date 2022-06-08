import axios from 'axios'

const state = {

    allAbilities: [],
    allStudiosForAbilities: [],

};

const getters = {

    allAbilities:(state) => state.allAbilities,
    allStudiosForAbilities:(state) => state.allStudiosForAbilities

};

const mutations = {

    setAbilities: (state, allAbilities) => (state.allAbilities = allAbilities),
    setStudiosForAbilities: (state, allStudios) => (state.allStudiosForAbilities = allStudios),

};


const actions = {

    async fetchAbilities({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_abilities'
        );

        commit('setAbilities', response.data);
    },


    async fetchStudiosForAbilities({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_studios_for_abilities'
        );

        commit('setStudiosForAbilities', response.data);
    },


    async deleteAbility({commit, dispatch}, id) {

        axios.post('/api/access-structure/api_delete_ability',
            {
                id
            }
        ).then(function (response) {

            dispatch('fetchAbilities');
            dispatch('triggerModalNotification', 'Запись удалена!');

        }).catch(function (error) {

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