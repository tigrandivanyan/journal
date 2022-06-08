import axios from 'axios'

const state = {

    allAssignedRoles: [],
    allRolesForAssignedRoles: [],
    allUsersForAssignedRoles: [],
    addAssignedRoleFormDisplay:false,
    newAssignedRole: {
        role_name:'',
        user_id:'',
        remove:'',
    }

};

const getters = {

    newAssignedRole:(state) => state.newAssignedRole,
    allAssignedRoles:(state) => state.allAssignedRoles,
    allRolesForAssignedRoles:(state) => state.allRolesForAssignedRoles,
    addAssignedRoleFormDisplayStatus:(state) => state.addAssignedRoleFormDisplay,
    allUsersForAssignedRoles:(state) => state.allUsersForAssignedRoles

};


const mutations = {

    setAssignedRoles: (state, assignedRoles) => (state.allAssignedRoles = assignedRoles),
    setRolesForAssignedRoles: (state, rolesForAssignedRoles) => (state.allRolesForAssignedRoles = rolesForAssignedRoles),
    setUsersForAssignedRoles:(state, usersForAssignedRoles) => (state.allUsersForAssignedRoles = usersForAssignedRoles),

    showAddAssignedRoleForm:(state) => (state.addAssignedRoleFormDisplay = true),
    hideAddAssignedRoleForm:(state) => (state.addAssignedRoleFormDisplay = false),

    setNewAssignedRoleRemoveStatus:(state) => (state.newAssignedRole.remove = true), // we doing this in case we retract role from user

    clearOldDataInNewAssignedRole:(state) => (state. newAssignedRole = {
        role_name:'',
        user_id:'',
        remove:'',
    })
};


const actions = {


    hideAddAssignedRoleForm({commit}) {
        commit('hideAddAssignedRoleForm');
    },

    showAddAssignedRoleForm({commit, dispatch }) {
        commit('showAddAssignedRoleForm');

        if(!state.addAssignedRoleFormDisplayStatus) {
            dispatch('fetchRolesForAssignedRoles');
            dispatch('fetchUsersForAssignedRoles');
        }
    },

    async retractAssignedRole({commit, dispatch}, newAssignedRole) {

        commit('setNewAssignedRoleRemoveStatus');

        dispatch('createAssignedRole', newAssignedRole);

    },

    async fetchAssignedRoles({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_assigned_roles'
        );

        commit('setAssignedRoles', response.data);
    },


    async fetchRolesForAssignedRoles({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_roles_for_assigned_roles'
        );

        commit('setRolesForAssignedRoles', response.data);
    },

    async fetchUsersForAssignedRoles({commit}) {

        const response = await axios.get(
            '/api/access-structure/api_get_users_for_assigned_roles'
        );

        commit('setUsersForAssignedRoles', response.data);
    },

    async createAssignedRole({commit, dispatch}, newAssignedRole) {

        axios.post('/api/access-structure/api_save_new_assigned_role', newAssignedRole)
            .then(function (response) {

                commit('hideAddAssignedRoleForm');
                commit('clearValidationErrors');
                commit('clearOldDataInNewAssignedRole');

                dispatch('fetchAssignedRoles');
                dispatch('fetchRolesForAssignedRoles');


                if(newAssignedRole.remove) {
                    dispatch('triggerModalNotification', 'Роль снята!');
                }else{
                    dispatch('triggerModalNotification', 'Новая роль назначена!');
                }


            }).catch(function (error) {

                commit('clearValidationErrors');
                commit('validationErrors', error.response.data);

                dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

            });

    },

    async deleteAssignedRole({commit, dispatch}, [role_id, user_id]) {

        const response = await axios.post(
            '/api/access-structure/api_delete_assigned_role',
            {
                role_id,
                user_id,
            }
        ).then(function (response) {

            commit('hideAddAssignedRoleForm');

            dispatch('fetchAssignedRoles');
            dispatch('fetchRolesForAssignedRoles');
            dispatch('triggerModalNotification', 'Запись удалена!');

        }).catch(function (error) {

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