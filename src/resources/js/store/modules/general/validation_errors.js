
const state = {
    validationErrorArray: [],
};

const getters = {

    validationErrors:(state) => state.validationErrorArray,

};

const actions = {


};

const mutations = {

    clearValidationErrors:(state) => (state.validationErrorArray = []),
    validationErrors:(state, errorArray) => (state.validationErrorArray = errorArray),

};

export default {
    state,
    getters,
    actions,
    mutations
}