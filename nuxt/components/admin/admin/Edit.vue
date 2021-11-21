 <template :ref="openEditModal">
  <v-dialog v-model="dialog" width="500">
    <v-card>
      <v-card-title>
        <span class="text-h5">管理者編集</span>
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
          <validation-provider
            v-slot="{ errors }"
            name="Email"
            rules="required"
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
            rules="required|password"
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
  </v-dialog>
</template>

<script>
export default {
  name: "Edit",
  props: {
    getAdminUsers: {
      type: Function,
      required: true,
    },
  },
  data() {
    return {
      form: {},
      dialog: false,
    };
  },
  methods: {
    close() {
      this.dialog = false;
    },
    open(item) {
      this.form = item;
      this.dialog = true;
    },
    async save() {
      let params = {
        name: this.form.name,
        email: this.form.email,
        passsword: this.form.passsword
      }
      this.$axios
        .$put(`/admins/${this.form.id}`, params)
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });

      this.close();
    },
  },
};
</script>
