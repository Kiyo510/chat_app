<template>
  <v-card v-show="dialog">
    <v-card-title>
      <span class="text-h5">管理者登録</span>
      <div v-if="Object.keys(validationErrors).length > 0">
        <v-alert v-for="(value, key) in validationErrors" :key="key" type="error">
          {{ value[0] }}
        </v-alert>
      </div>
    </v-card-title>

    <v-card-text>
      <v-form @submit.prevent="submit">
        <validation-provider v-slot="{ errors }" name="Name" rules="required">
          <v-text-field
            v-model="form.name"
            label="Name"
            :error-messages="errors"
            prepend-icon="mdi-account-circle"
            required
          >
          </v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Email" rules="required">
          <v-text-field
            v-model="form.email"
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
            v-model="form.password"
            label="Password"
            :error-messages="errors"
            prepend-icon="mdi-lock"
            required
          ></v-text-field>
        </validation-provider>
      </v-form>
    </v-card-text>

    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="blue darken-1" text @click="close"> 閉じる </v-btn>
      <v-btn color="blue darken-1" text @click="save"> 登録 </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: "Create",
  props: {
    getAdminUsers: {
      type: Function,
      required: true,
    },
    dialog: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  methods: {
    close() {
      this.$emit("close-modal");
    },
    async save() {
      this.$axios
        .$post("/admins", this.form)
        .then((res) => {
          this.close();
          this.getAdminUsers();
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
};
</script>
