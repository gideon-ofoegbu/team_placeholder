
// initial state
const state = {
    user: null,
}

// getters
const getters = {}

// actions
const actions = {
    //{ commit, state }
    userAuthenticated ({ commit }, userdt) {
        commit('setUser', userdt);
    },
    logOut({ commit }){
        commit('setUser', null);
    }
}

// mutations
const mutations = {
    //state
    setUser(state, userdt){
        state.user = userdt;
    }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}