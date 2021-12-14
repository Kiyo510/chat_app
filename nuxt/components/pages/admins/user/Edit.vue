 <template :ref="openEditModal">
  <v-dialog v-model="dialog" width="600px">
    <v-card>
      <v-card-title>
        <span class="text-h5">ユーザー編集</span>
      </v-card-title>
      <div v-if="Object.keys(validationErrors).length > 0">
        <v-alert
          v-for="(value, key) in validationErrors"
          :key="key"
          type="error"
          width="580px"
          class="mx-auto pa-3 ma-2 text-body-2"
        >
          {{ value[0] }}
        </v-alert>
      </div>
      <v-card-text>
        <v-form @submit.prevent="submit">
          <validation-provider v-slot="{ errors }" name="Name" rules="required">
            <v-text-field
              v-model="user.name"
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
              v-model="user.email"
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
            :rules="{
              min: 8,
              regex: '^.*(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$',
            }"
          >
            <v-text-field
              type="password"
              v-model="user.password"
              label="Password"
              :error-messages="errors"
              prepend-icon="mdi-lock"
            ></v-text-field>
          </validation-provider>
        </v-form>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="close"> 閉じる </v-btn>
        <v-btn color="blue darken-1" text @click="save"> 更新 </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "Edit",
  data() {
    return {
      user: {},
      dialog: false,
    };
  },
  methods: {
    close() {
      this.dialog = false;
    },
    open(item) {
      this.user = item;
      this.dialog = true;
    },
    async save() {
      let params = {
        id: this.user.id,
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
      };
      this.$axios
        .$put(`/users/${this.user.id}`, params)
        .then((res) => {
          this.$toast.global.success_message();
          this.close();
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
};
</script>
