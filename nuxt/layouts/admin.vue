<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app dark>
      <AdminSidebar />
    </v-navigation-drawer>
    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>管理画面</v-toolbar-title>
      <v-row justify="end">
        <v-btn class="red white--text" @click="logout" type="submit"
          >ログアウト</v-btn
        >
      </v-row>
    </v-app-bar>
    <v-main>
      <Nuxt />
    </v-main>
  </v-app>
</template>

<script>
import AdminSidebar from "@/components/admin/Sidebar.vue";

export default {
  middleware: "not_logined_admin_user",
  name: "admin",
  components: {
    AdminSidebar,
  },
  data: () => ({
    drawer: true,
  }),
  methods: {
    async logout() {
      await this.$store.dispatch("auth/logout");
      this.$router.push("/admin/login");
    },
  },
};
</script>
