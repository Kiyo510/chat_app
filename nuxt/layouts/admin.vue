<template>
  <v-app id="inspire">
    <AdminNavBar @click="switchDrawer" @logout="logout"/>
    <v-navigation-drawer v-model="drawer" app dark>
      <AdminSidebar />
    </v-navigation-drawer>
    <v-main>
      <Nuxt />
    </v-main>
  </v-app>
</template>

<script>
import AdminSidebar from "@/components/layouts/admins/Sidebar.vue";
import AdminNavBar from "@/components/layouts/admins/NavBar.vue";

export default {
  middleware: "not_logined_admin_user",
  name: "admin",
  components: {
    AdminSidebar,
    AdminNavBar,
  },
  data: () => ({
    drawer: true,
  }),
  methods: {
    async logout() {
      await this.$store.dispatch("auth/logout");
      this.$router.push("/admin/login");
    },
    switchDrawer() {
      this.drawer = !this.drawer
    }
  },
};
</script>
