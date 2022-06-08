import axios from 'axios'


const state = {

    allBallTechnicians: [],
    allDeletedBallTechnicians: [],
    addBallTechnicianFormDisplay:false,
    editBallTechnicianFormDisplay:false,
    restoreBallTechniciansTableDisplay:false,
    newBallTechnician: {
        id:'',
        username:'',
        name_ru:'',
        name_lv:'',
        number:'',
        ball_tech_admin:false,
        password:'',
        password_confirmation:''
    }

};

const getters = {

    newBallTechnician:(state) => state.newBallTechnician,
    allBallTechnicians:(state) => state.allBallTechnicians,
    allDeletedBallTechnicians:(state) => state.allDeletedBallTechnicians,
    addBallTechnicianFormDisplayStatus:(state) => state.addBallTechnicianFormDisplay,
    editBallTechnicianFormDisplayStatus:(state) => state.editBallTechnicianFormDisplay,
    restoreBallTechniciansTableDisplayStatus:(state) => state.restoreBallTechniciansTableDisplay,

};

const mutations = {

    setBallTechnicians: (state, BallTechnicians) => (state.allBallTechnicians = BallTechnicians),
    setDeletedBallTechnicians: (state, BallTechnicians) => (state.allDeletedBallTechnicians = BallTechnicians),

    showAddBallTechnicianForm:(state) => (state.addBallTechnicianFormDisplay = true),
    hideAddBallTechnicianForm:(state) => (state.addBallTechnicianFormDisplay = false),

    showEditBallTechnicianForm:(state) => (state.editBallTechnicianFormDisplay = true),
    hideEditBallTechnicianForm:(state) => (state.editBallTechnicianFormDisplay = false),

    hideRestoreBallTechniciansTable:(state) => (state.restoreBallTechniciansTableDisplay = false),
    switchRestoreBallTechniciansTableDisplayStatus:(state) => (state.restoreBallTechniciansTableDisplay = !state.restoreBallTechniciansTableDisplay),

    setEditedBallTechnicianData:(state, user) => (state. newBallTechnician = {
        id: user.id,
        username: user.username,
        name_ru: user.ball_technician.name_ru,
        name_lv: user.ball_technician.name_lv,
        number: user.ball_technician.number,
        ball_tech_admin: user.ball_technician.ball_tech_admin,
    }),
    clearOldDataInNewBallTechnician:(state) => (state. newBallTechnician = {
        id:'',
        username:'',
        name_ru:'',
        name_lv:'',
        number:'',
        ball_tech_admin:false,
        password:'',
        password_confirmation:'',
    })
};

const actions = {

    hideAddBallTechnicianForm({commit}) {  // represents Cancel button click in form
        commit('hideAddBallTechnicianForm');
    },

    hideEditBallTechnicianForm({commit}) {  // represents Cancel button click in form
        commit('hideEditBallTechnicianForm');
    },

    showAddBallTechnicianForm({commit}) {  // represents addBallTechnician form Show button click
        commit('hideEditBallTechnicianForm');
        commit('hideRestoreBallTechniciansTable');
        commit('clearOldDataInNewBallTechnician'); // this one clears data in form if it stayed there after editing action
        commit('clearValidationErrors');
        commit('showAddBallTechnicianForm');
    },

    showEditBallTechnicianForm({commit, dispatch }, ballTechnician) { // represents editBallTechnician form Show button click
        commit('hideAddBallTechnicianForm');
        commit('hideRestoreBallTechniciansTable');
        commit('clearValidationErrors');
        commit('setEditedBallTechnicianData', ballTechnician);
        commit('showEditBallTechnicianForm');
    },

    switchRestoreBallTechniciansTableDisplayStatus({commit, state, dispatch}) {   // represents restoreBallTechnician table Show/Hide button click
        if(!state.restoreBallTechniciansTableDisplay){ // load deleted ball technicians only when we open table
            commit('hideAddBallTechnicianForm');
            commit('hideEditBallTechnicianForm');

            dispatch('fetchDeletedBallTechnicians');
        }
        commit('switchRestoreBallTechniciansTableDisplayStatus');
    },
    
    async fetchBallTechnicians({commit}) {

        const response = await axios.get(
            '/api/staff/ball_technician/api_get_ball_technicians'
        );

        commit('setBallTechnicians', response.data);
    },

    async fetchDeletedBallTechnicians({commit}) {

        const response = await axios.get(
            '/api/staff/ball_technician/api_get_deleted_ball_technicians'
        );

        commit('setDeletedBallTechnicians', response.data);
    },

    async createBallTechnician({commit, dispatch}, new_ball_technician) {

        axios.post('/api/staff/ball_technician/api_save_new_ball_technician', new_ball_technician)
            .then(function (response) {

                commit('hideAddBallTechnicianForm');
                commit('clearValidationErrors');
                commit('clearOldDataInNewBallTechnician');

                dispatch('fetchBallTechnicians');
                dispatch('triggerModalNotification', 'Новая запись сохранена!');

            }).catch(function (error) {

                commit('clearValidationErrors');
                commit('validationErrors', error.response.data.errors);

                dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

            });

    },

    async saveBallTechnicianChanges ({commit, dispatch}, new_ball_technician) {

        axios.post('/api/staff/ball_technician/api_save_ball_technician_changes', new_ball_technician)
            .then(function (response) {

                commit('hideEditBallTechnicianForm');
                commit('clearValidationErrors');
                commit('clearOldDataInNewBallTechnician');

                dispatch('fetchBallTechnicians');
                dispatch('triggerModalNotification', 'Изменения сохранены!');

            }) .catch(function (error) {

                commit('clearValidationErrors');
                commit('validationErrors', error.response.data);

                dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

            });
    },


    async restoreBallTechnician({commit, dispatch}, ball_technician_user_id) {

        const response = await axios.post(
            '/api/staff/ball_technician/api_restore_ball_technician',
            {
                ball_technician_user_id,
            }
        ).then(function (response) {

            dispatch('fetchBallTechnicians');
            dispatch('fetchDeletedBallTechnicians');
            dispatch('triggerModalNotification', 'Техник по шарам восстановлен!');

        }).catch(function (error) {

            dispatch('triggerModalNotification', 'Что-то пошло не так, попробуйте снова!');

        });
    },


    async deleteBallTechnician({commit, dispatch}, user_id) {

        const response = await axios.post(
            '/api/staff/ball_technician/api_delete_ball_technician',
            {
                user_id,
            }
        ).then(function (response) {

            commit('hideAddBallTechnicianForm');
            commit('hideEditBallTechnicianForm');

            dispatch('fetchBallTechnicians');
            dispatch('fetchDeletedBallTechnicians');
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