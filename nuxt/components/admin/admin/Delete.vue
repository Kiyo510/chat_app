 <template :ref="openEditModal">
  <v-dialog v-model="dialog" width="300">
    <v-card>
      <v-card-text class="text-center pt-5">
        <v-form @submit.prevent="submit">
          {{ deleteComfirmMessage }}
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue" @click="close"> キャンセル </v-btn>
        <v-btn color="red white--text" @click="deleteAdmin(item)"> 削除 </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  layout: "Delete",
  data() {
    return {
      item: {},
      dialog: false,
      deleteComfirmMessage: "本当に削除しますか？",
    };
  },
  methods: {
    open(item) {
      this.item = item;
      this.dialog = true;
    },
    close() {
      this.dialog = false;
    },
    async deleteAdmin(item) {
      await this.$axios
        .$delete(`/admins/${item.id}`)
        .then((res) => {
            this.close();
            this.$toast.global.success_message({ message: "削除しました" });
            //FIXME: リロードしないと、$refsが何故かundefinedになってしまい削除できないのでやむなく強制リロード(ページネーションさせるとうまくうごく。)
            // this.$router.go({
            //   path: this.$router.currentRoute.path,
            //   force: true,
            // });
            this.$emit('get-admin-users');
        })
        .catch((err) => {
          // this.submitStatus = "ERROR";
          // this.error = err.response;
          // this.$sentry.captureException(err);
        });
    },
  },
};
</script>
