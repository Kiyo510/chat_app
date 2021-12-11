export const state = () => ({
  showLoading: false
})

export const mutations = {
  loadingStart(state) {
    state.showLoading = true
  },
  loadingStop(state) {
    state.showLoading = false
  }
}

export const actions = {
  loadingStart({ commit }) {
    if (process.browser) {
      commit('loadingStart')
    }
  },
  loadingStop({ commit }) {
    if (process.browser) {
      commit('loadingStop')
    }
  }
}

export const getters = {
  showLoading(state) {
    return state.showLoading
  }
}
