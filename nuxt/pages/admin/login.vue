<template>
  <v-app>
    <v-card width="500px" class="mx-auto mt-15">
      <v-card-title>管理画面</v-card-title>
      <validation-observer ref="observer">
        <v-card-text>
          <v-form @submit.prevent="submit">
            <validation-provider
              v-slot="{ errors }"
              name="Email"
              rules="required"
            >
              <v-text-field
                v-model="email"
                label="Email"
                :error-messages="errors"
                prepend-icon="mdi-account-circle"
                required
              >
              </v-text-field>
            </validation-provider>
            <validation-provider
              v-slot="{ errors }"
              name="password"
              rules="required"
            >
              <v-text-field
                type="password"
                v-model="password"
                label="Password"
                :error-messages="errors"
                prepend-icon="mdi-lock"
                required
              ></v-text-field>
            </validation-provider>
            <div class="text-center">
              <v-btn class="info" type="submit">Login</v-btn>
            </div>
          </v-form>
        </v-card-text>
      </validation-observer>
    </v-card>
  </v-app>
</template>

<script>
export default {
  middleware: "logined_admin_user",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    async submit() {
      await this.$store.dispatch("auth/login", {
        email: this.email,
        password: this.password,
      });
      this.$router.push("/admin/dashboard");
    },
  },
};
</script>

<style lang="css" scoped>
#app {
  background-color: rgb(202, 202, 202);
}
</style>
