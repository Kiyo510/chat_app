<template>
  <v-card height="100%" width="256" class="mx-auto">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="text-h6"> Application </v-list-item-title>
        <v-list-item-subtitle> subtext </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

    <v-list dense nav>
      <v-list-item v-for="item in items" :key="item.title">
        <v-list-item-icon>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>
            <nuxt-link :to="item.to">{{ item.title }}</nuxt-link>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      items: [
        {
          icon: "mdi-apps",
          title: "ダッシュボード",
          to: "/admin/",
        },
        {
          icon: "mdi-chart-bubble",
          title: "管理者管理",
          to: "/admin/list",
        },
        {
          icon: "mdi-account",
          title: "ユーザー一覧",
          to: "/admin/users",
        },
      ],
    };
  },
};
</script>
<style lang="scss" scoped>
a {
  color: #FFFFFF;
  text-decoration: none;
}
</style>
