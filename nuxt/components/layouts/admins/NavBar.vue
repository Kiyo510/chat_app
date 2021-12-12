<template>
  <v-app-bar app>
    <v-app-bar-nav-icon @click="switchDrawer"></v-app-bar-nav-icon>
    <v-toolbar-title>管理画面</v-toolbar-title>
    <v-row justify="end">
      <v-btn class="red white--text" @click="logout" type="submit"
        >ログアウト</v-btn
      >
    </v-row>
  </v-app-bar>
</template>
<script>
export default {
  methods: {
    switchDrawer() {
      this.$emit("click");
    },
    logout() {
      this.$emit("logout");
    },
  },
};
</script>
