<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app dark>
      <AdminSidebar />
    </v-navigation-drawer>
    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>管理画面</v-toolbar-title>
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
  components: {
    AdminSidebar,
  },
  data: () => ({
    drawer: true,
  }),
};
</script>
