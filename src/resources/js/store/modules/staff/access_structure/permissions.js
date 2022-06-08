import axios from 'axios'

const state = {
    allPermissions: [],
    allAbilities: [],
    allUsers: [],
    allRoles: [],
    newPermissionFormDisplay:false,
    validationErrorArray: [],
    newPermission: {
        role_name:'',
        user_id:'',
        ability_name:'',
        entity_type:'',
        entity_id:'',
        existing_ability:'',
        radioRoleUserInput:'',
        remove:'',
        own:'',
    }
};

const getters = {
    allPermissions:(state) => state.allPermissions,
    allAbilitiesForPermissions:(state) => state.allAbilities,
    allUsersForPermissions:(state) => state.allUsers,
    allRolesForPermissions:(state) => state.allRoles,
    addPermissionFormDisplayStatus:(state) => state.newPermissionFormDisplay,
    newPermission:(state) => state.newPermission,
    allValidationErrorsForPermissions:(state) => state.validationErrorArray,
};

const mutations = {

    setPermissions: (state, permissions) => (state.allPermissions = permissions),
    setAbilities: (state, abilities) => (state.allAbilities = abilities),
    setRoles: (state, roles) => (state.allRoles = roles),
    setUsers: (state, users) => (state.allUsers = users),

// hide/show form
    showAddPermissionForm:(state) => (state.newPermissionFormDisplay = true),
    hideAddPermissionForm:(state) => (state.newPermissionFormDisplay = false),

    clearValidationErrors:(state) => (state.validationErrorArray = []),
    validationErrors:(state, errorArray) => (state.validationErrorArray = errorArray),
    clearOldDataInNewPermission:(state) => (state. newPermission = {
        role_name:'',
        user_id:'',
        ability_name:'',
        entity_type:'',
        entity_id:'',
        existing_ability:'',
        radioRoleUserInput:'',
        remove:'',
        own:'',
    })
};


const actions = {

    showAddPermissionForm({commit}) {
        commit('showAddPermissionForm');
    },

    hideAddPermissionForm({commit}) {
        commit('hideAddPermissionForm');
    },

    async fetchPermissions({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_permissions'
        );

        commit('setPermissions', response.data);
    },

    async fetchAbilitiesForPermissions({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_abilities_for_permissions'
        );

        commit('setAbilities', response.data);
    },


    async fetchRolesForPermissions({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_roles_for_permissions'
        );

        commit('setRoles', response.data);
    },

    async fetchUsersForPermissions({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_users_for_permissions'
        );

        commit('setUsers', response.data);
    },

    async createPermission({commit, dispatch}, newPermission) {

        axios.post('/api/access-structure/api_save_new_permission', newPermission)
            .then(function (response) {

                commit('hideAddPermissionForm');
                commit('clearValidationErrors');
                commit('clearOldDataInNewPermission');

                dispatch('fetchPermissions');
                dispatch('fetchAbilitiesForPermissions');
                dispatch('triggerModalNotification', 'Новые права назначены!');

            })
            .catch(function (error) {

                commit('clearValidationErrors');
                commit('validationErrors', error.response.data);
                dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

            });

    },

    async deletePermission({commit, dispatch}, [ability_id, entity_id]) {

        const response = await axios.post(
            '/api/access-structure/api_delete_permission',
            {
                ability_id,
                entity_id
            }
        ).then(function (response) {

            commit('hideAddPermissionForm');

            dispatch('fetchPermissions');
            dispatch('triggerModalNotification', 'Запись удалена!');


        }).catch(function (error) {

            commit('clearValidationErrors');
            commit('validationErrors', error.response.data);
            dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

        });

    },

};



export default {
    state,
    getters,
    actions,
    mutations
}