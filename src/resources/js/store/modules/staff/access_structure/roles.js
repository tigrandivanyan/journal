import axios from 'axios'

const state = {
    allRoles: [],
};

const getters = {
    allRoles:(state) => state.allRoles,
};

const actions = {


    async fetchRoles({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_roles'
        );

        commit('setRoles', response.data);
    },

    async deleteRole({dispatch}, id) {

        const response = await axios.post(
            '/api/access-structure/api_delete_role',
            {
                id
            }
        ).then(function (response) {

            dispatch('fetchRoles');
            dispatch('triggerModalNotification', 'Запись удалена!');


        }).catch(function (error) {

            dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

        });

    }

};

const mutations = {
    setRoles: (state, roles) => (state.allRoles = roles),
};

export default {
    state,
    getters,
    actions,
    mutations
}