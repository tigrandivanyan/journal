import axios from 'axios'

const state = {

    allOperators: [],
    allDeletedOperators: [],
    allStudiosForOperators: [],
    addOperatorFormDisplay:false,
    editOperatorFormDisplay:false,
    restoreOperatorsTableDisplay:false,
    newOperator: {
        id:'',
        username:'',
        name_ru:'',
        name_lv:'',
        number:'',
        studio_id:'',
        studio_id_for_change:'',
        password:'',
        password_confirmation:'',
    }

};

const getters = {

    newOperator:(state) => state.newOperator,
    allOperators:(state) => state.allOperators,
    allDeletedOperators:(state) => state.allDeletedOperators,
    allStudiosForOperators:(state) => state.allStudiosForOperators,
    addOperatorFormDisplayStatus:(state) => state.addOperatorFormDisplay,
    editOperatorFormDisplayStatus:(state) => state.editOperatorFormDisplay,
    restoreOperatorsTableDisplayStatus:(state) => state.restoreOperatorsTableDisplay,

};

const mutations = {

    setOperators: (state, operators) => (state.allOperators = operators),
    setDeletedOperators: (state, deletedOperators) => (state.allDeletedOperators = deletedOperators),
    setStudiosForOperators: (state, studios) => (state.allStudiosForOperators = studios),

    showAddOperatorForm:(state) => (state.addOperatorFormDisplay = true),
    hideAddOperatorForm:(state) => (state.addOperatorFormDisplay = false),

    showEditOperatorForm:(state) => (state.editOperatorFormDisplay = true),
    hideEditOperatorForm:(state) => (state.editOperatorFormDisplay = false),

    hideRestoreOperatorsTable:(state) => (state.restoreOperatorsTableDisplay = false),
    switchRestoreOperatorsTableDisplayStatus:(state) => (state.restoreOperatorsTableDisplay = !state.restoreOperatorsTableDisplay),

    setEditedOperatorData:(state, user) => (state. newOperator = {
        id: user.id,
        username: user.username,
        name_ru: user.operator.name_ru,
        name_lv: user.operator.name_lv,
        number: user.operator.number,
        studio_id: user.operator.studio_id,
    }),
    clearOldDataInNewOperator:(state) => (state. newOperator = {
        id:'',
        username:'',
        name_ru:'',
        name_lv:'',
        number:'',
        studio_id:'',
        studio_id_for_change:'',
        password:'',
        password_confirmation:'',
    })
};


const actions = {

    hideAddOperatorForm({commit}) {  // represents Cancel button click in form
        commit('hideAddOperatorForm');
    },

    hideEditOperatorForm({commit}) {  // represents Cancel button click in form
        commit('hideEditOperatorForm');
    },

    showAddOperatorForm({commit}) {  // represents addOperator form Show button click
        commit('hideEditOperatorForm');
        commit('hideRestoreOperatorsTable');
        commit('clearOldDataInNewOperator'); // this one clears data in form if it stayed there after editing action
        commit('clearValidationErrors');
        commit('showAddOperatorForm');
    },

    showEditOperatorForm({commit}, operator) {  // represents editOperator form Show button click
        commit('hideAddOperatorForm');
        commit('hideRestoreOperatorsTable');
        commit('clearValidationErrors');
        commit('setEditedOperatorData', operator);
        commit('showEditOperatorForm');
    },

    switchRestoreOperatorsTableDisplayStatus({commit, state, dispatch}) {   // represents restoreBallTechnician table Show/Hide button click
        if(!state.restoreOperatorsTableDisplay){ // load deleted operators when we open table with them
            commit('hideAddOperatorForm');
            commit('hideEditOperatorForm');

            dispatch('fetchDeletedOperators');
        }
        commit('switchRestoreOperatorsTableDisplayStatus');
    },

    async fetchOperators({commit}, studio_id) {

        const response = await axios.post(
            '/api/staff/operator/api_get_operators',
            {
                studio_id
            }
        );

        commit('setOperators', response.data);
    },
    
    async fetchDeletedOperators({commit}) {

        const response = await axios.get(
            '/api/staff/operator/api_get_deleted_operators'
        );

        commit('setDeletedOperators', response.data);
    },

    async fetchStudiosForOperators({commit}) {

        const response = await axios.get(
            '/api/staff/operator/api_get_studios_for_operators'
        );

        commit('setStudiosForOperators', response.data);
    },

    async createOperator({commit, dispatch}, newOperator) {

        axios.post('/api/staff/operator/api_save_new_operator', newOperator)
            .then(function (response) {

                commit('hideAddOperatorForm');
                commit('clearValidationErrors');
                commit('clearOldDataInNewOperator');

                dispatch('fetchOperators', newOperator.studio_id);
                dispatch('triggerModalNotification', 'Новая запись сохранена!');

            }).catch(function (error) {

                commit('clearValidationErrors');
                commit('validationErrors', error.response.data.errors);

                dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

            });

    },

    async saveOperatorChanges ({commit, dispatch}, newOperator) {

        axios.post('/api/staff/operator/api_save_operator_changes', newOperator)
            .then(function (response) {

                commit('hideEditOperatorForm');
                commit('clearValidationErrors');
                commit('clearOldDataInNewOperator');

                dispatch('triggerModalNotification', 'Изменения сохранены!');

                if(newOperator.studio_id_for_change){
                    dispatch('fetchOperators',newOperator.studio_id_for_change);
                }else{
                    dispatch('fetchOperators',newOperator.studio_id);
                }

            }).catch(function (error) {

                commit('clearValidationErrors');
                commit('validationErrors', error.response.data);

                dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

            });
    },

    async restoreOperator({dispatch}, [user_id, operator_studio_id]) {

        const response = await axios.post(
            '/api/staff/operator/api_restore_operator',
            {
                user_id,
                operator_studio_id
            }
        ).then(function (response) {

            dispatch('fetchOperators', operator_studio_id);
            dispatch('fetchDeletedOperators');
            dispatch('triggerModalNotification', 'Оператор восстановлен!');

        }).catch(function (error) {

            dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

        });
    },
    
    
    async deleteOperator({commit, dispatch}, [user_id, operator_studio_id]) {

        const response = await axios.post(
            '/api/staff/operator/api_delete_operator',
            {
                user_id,
            }
        ).then(function (response) {

            commit('hideAddOperatorForm');
            commit('hideEditOperatorForm');

            dispatch('fetchOperators', operator_studio_id);
            dispatch('fetchDeletedOperators');
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