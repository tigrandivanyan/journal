import axios from 'axios'

const state = {

    allUsersForAdministrator: [],
    userIdForAdministratorRoleRetract: '',
    addAdministratorFormDisplay:false,

    // allStudiosForOperators: [],
    // editOperatorFormDisplay:false,
    // restoreOperatorsTableDisplay:false,
    newAdministrator: {
        id:'',
        username:'',
        password:'',
        password_confirmation:'',
    }

};

const getters = {

    newAdministrator:(state) => state.newAdministrator,
    allUsersForAdministrator:(state) => state.allUsersForAdministrator,
    userIdForAdministratorRoleRetract:(state) => state.userIdForAdministratorRoleRetract,
    addAdministratorFormDisplayStatus:(state) => state.addAdministratorFormDisplay,

    // allDeletedOperators:(state) => state.allDeletedOperators,
    // allStudiosForOperators:(state) => state.allStudiosForOperators,
    // editOperatorFormDisplayStatus:(state) => state.editOperatorFormDisplay,
    // restoreOperatorsTableDisplayStatus:(state) => state.restoreOperatorsTableDisplay,

};

const mutations = {

    setUsersForAdministrator: (state, allUsers) => (state.allUsersForAdministrator = allUsers),
    setUserIdForAdministratorRoleRetract: (state, user_id) => (state.userIdForAdministratorRoleRetract = user_id),

    showAddAdministratorForm:(state) => (state.addAdministratorFormDisplay = true),
    hideAddAdministratorForm:(state) => (state.addAdministratorFormDisplay = false),

    clearOldDataInNewAdministrator:(state) => (state. newAdministrator = {
        id:'',
        username:'',
        password:'',
        password_confirmation:'',
    })
    // setStudiosForOperators: (state, studios) => (state.allStudiosForOperators = studios),
    //

    //
    // showEditOperatorForm:(state) => (state.editOperatorFormDisplay = true),
    // hideEditOperatorForm:(state) => (state.editOperatorFormDisplay = false),
    //
    // hideRestoreOperatorsTable:(state) => (state.restoreOperatorsTableDisplay = false),
    // switchRestoreOperatorsTableDisplayStatus:(state) => (state.restoreOperatorsTableDisplay = !state.restoreOperatorsTableDisplay),


};


const actions = {


    showAddNewAdministratorForm({commit}) {  // represents addOperator form Show button click
        commit('clearOldDataInNewAdministrator'); // this one clears data in form if it stayed there after editing action
        commit('clearValidationErrors');
        commit('showAddAdministratorForm');
    },


    hideAddAdministratorForm({commit}) {  // represents Cancel button click in form
        commit('hideAddAdministratorForm');
    },


    async fetchUsersForAdministrator({commit},) {

        const response = await axios.get(
            '/api/staff/administrator/api-get-users-for-administrator'
        );

        commit('setUsersForAdministrator', response.data);
    },



    setUserIdForAdministratorRoleRetract({commit}, user_id) {  // represents Cancel button click in form
        commit('setUserIdForAdministratorRoleRetract', user_id);
    },



    async retractAdministratorRoleFromUser({commit, dispatch}, user_id) {

        axios.post('/api/staff/administrator/api-retract-administrator-role-from-user', {user_id})
            .then(function (response) {

                dispatch('triggerModalNotification', 'Роль Администратора удалена у пользователя!');

                dispatch('fetchUsersForAdministrator');

            }).catch(function (error) {

            dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

        });
    },


    async createAdministrator({commit, dispatch}, newAdministrator) {

        axios.post('/api/staff/administrator/api-save-new-administrator', newAdministrator)
            .then(function (response) {

                commit('hideAddAdministratorForm');
                commit('clearValidationErrors');
                commit('clearOldDataInNewAdministrator');

                dispatch('fetchUsersForAdministrator');
                dispatch('triggerModalNotification', 'Новая запись сохранена!');

            }).catch(function (error) {

            commit('clearValidationErrors');
            commit('validationErrors', error.response.data.errors);
            // console.log(44);
            console.log(error.response.data.errors);

            dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

        });

    },




    //
    // showEditOperatorForm({commit}, operator) {  // represents editOperator form Show button click
    //     commit('hideAddOperatorForm');
    //     commit('hideRestoreOperatorsTable');
    //     commit('clearValidationErrors');
    //     commit('setEditedOperatorData', operator);
    //     commit('showEditOperatorForm');
    // },
    //
    // switchRestoreOperatorsTableDisplayStatus({commit, state, dispatch}) {   // represents restoreBallTechnician table Show/Hide button click
    //     if(!state.restoreOperatorsTableDisplay){ // load deleted operators when we open table with them
    //         commit('hideAddOperatorForm');
    //         commit('hideEditOperatorForm');
    //
    //         dispatch('fetchDeletedOperators');
    //     }
    //     commit('switchRestoreOperatorsTableDisplayStatus');
    // },
    //


    // async fetchStudiosForOperators({commit}) {
    //
    //     const response = await axios.get(
    //         '/api/staff/operator/api_get_studios_for_operators'
    //     );
    //
    //     commit('setStudiosForOperators', response.data);
    // },
    //

    //
    // async saveOperatorChanges ({commit, dispatch}, newOperator) {
    //
    //     axios.post('/api/staff/operator/api_save_operator_changes', newOperator)
    //         .then(function (response) {
    //
    //             commit('hideEditOperatorForm');
    //             commit('clearValidationErrors');
    //             commit('clearOldDataInNewOperator');
    //
    //             dispatch('triggerModalNotification', 'Изменения сохранены!');
    //
    //             if(newOperator.studio_id_for_change){
    //                 dispatch('fetchOperators',newOperator.studio_id_for_change);
    //             }else{
    //                 dispatch('fetchOperators',newOperator.studio_id);
    //             }
    //
    //         }).catch(function (error) {
    //
    //             commit('clearValidationErrors');
    //             commit('validationErrors', error.response.data);
    //
    //             dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');
    //
    //         });
    // },
    //
    // async restoreOperator({dispatch}, [user_id, operator_studio_id]) {
    //
    //     const response = await axios.post(
    //         '/api/staff/operator/api_restore_operator',
    //         {
    //             user_id,
    //             operator_studio_id
    //         }
    //     ).then(function (response) {
    //
    //         dispatch('fetchOperators', operator_studio_id);
    //         dispatch('fetchDeletedOperators');
    //         dispatch('triggerModalNotification', 'Оператор восстановлен!');
    //
    //     }).catch(function (error) {
    //
    //         dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');
    //
    //     });
    // },
    //
    //
    // async deleteOperator({commit, dispatch}, [user_id, operator_studio_id]) {
    //
    //     const response = await axios.post(
    //         '/api/staff/operator/api_delete_operator',
    //         {
    //             user_id,
    //         }
    //     ).then(function (response) {
    //
    //         commit('hideAddOperatorForm');
    //         commit('hideEditOperatorForm');
    //
    //         dispatch('fetchOperators', operator_studio_id);
    //         dispatch('fetchDeletedOperators');
    //         dispatch('triggerModalNotification', 'Запись удалена!');
    //
    //     }).catch(function (error) {
    //
    //         dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');
    //
    //     });
    // }
};



export default {
    state,
    getters,
    mutations,
    actions

}