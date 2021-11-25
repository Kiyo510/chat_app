export const actions = {
  async nuxtServerInit({ commit }, { app }) {
    console.log(111111);
    await app.$axios
      .$get("/current_admin_user")
      .then(admin_user => commit("auth/setAdminUser", admin_user))
      .catch(() => commit("auth/setAdminUser", null));
  }
};
