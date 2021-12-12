<template>
  <v-dialog v-model="dialog" width="600px">
    <v-card v-show="dialog">
      <v-card-title>
        <span class="text-h5">ユーザー登録</span>
      </v-card-title>
      <AlertMessage
        width="'580px'"
        alertClass="'mx-auto pa-3 ma-2 text-body-2'"
      />
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
          <validation-provider
            v-slot="{ errors }"
            name="Email"
            rules="required|email"
          >
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
        <CancelButton
          @close="close"
          :text="'閉じる'"
          :color="'#dcdcdc'"
          class="mr-3"
        />
        <SubmitButton :color="'blue darken-1'" :text="'登録'" @click="save" />
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "Create",
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
      },
      dialog: false,
    };
  },
  methods: {
    open() {
      this.dialog = true;
    },
    close() {
      this.dialog = false;
    },
    async save() {
      this.$axios
        .$post("/users", this.form)
        .then((res) => {
          this.close();
          this.$toast.global.success_message({ message: "登録しました" });
          this.$emit("get-all-data");
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
};
</script>
