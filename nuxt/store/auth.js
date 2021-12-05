export const state = () => ({
  admin_user: null
});

export const mutations = {
  setAdminUser(state, admin_user) {
    state.admin_user = admin_user;
  }
};

export const actions = {
  async login({ commit }, { email, password }) {
    const response = await this.$axios
      .$post("/login", { email, password })
      .catch(err => {
        console.log(err);
      });
    commit("setAdminUser", response);
  },
  async logout({ commit }) {
    const response = await this.$axios.$post("/logout")
      .catch(err => {
        console.log(err);
      });
    commit('setAdminUser', null);
  }
};
