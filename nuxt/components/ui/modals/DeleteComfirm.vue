 <template>
  <v-dialog v-model="dialog" width="300">
    <v-card>
      <v-card-text class="text-center pt-5">
        <v-form @submit.prevent="submit">
          {{ deleteComfirmMessage }}
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <CancelButton @close="close" :text="'キャンセル'" :color="'#dcdcdc'" class="mr-3"/>
        <DeleteButton @delete-data="deleteData(item, endPoint)" />
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    endPoint: {
      type: String,
      required: true,
    },
  },
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
    async deleteData(item, endPoint) {
      await this.$axios
        .$delete(`/${endPoint}/${item.id}`)
        .then((res) => {
          this.close();
          this.$toast.global.success_message({ message: "削除しました" });
          //FIXME: リロードしないと、$refsが何故かundefinedになってしまい削除できないのでやむなく強制リロード(ページネーションさせるとうまくうごく。)
          // this.$router.go({
          //   path: this.$router.currentRoute.path,
          //   force: true,
          // });
          this.$emit("get-all-data");
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
