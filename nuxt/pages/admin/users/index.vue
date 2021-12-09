<template>
  <div>
    <v-card width="980px" class="mx-auto mt-8">
      <v-data-table
        :headers="headers"
        :items="users"
        :items-per-page="perPage"
        :loading="loading"
        loading-text="Loading... Please wait"
        class="elevation-1"
        hide-default-footer
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>ユーザー管理</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" width="600px">
              <template v-slot:activator="{ on, attrs }">
                <v-row justify="end" class="mr-1">
                  <v-btn color="primary" dark v-bind="attrs" v-on="on">
                    新規登録
                  </v-btn>
                </v-row>
              </template>
              <Create
                :dialog="dialog"
                :get-users="getUsers"
                @close-modal="close"
              />
            </v-dialog>
          </v-toolbar>
        </template>
        <template v-slot:[`item.action`]="{ item }">
          <v-icon small class="mr-2" @click="openEditModal(item)">
            mdi-pencil
          </v-icon>
          <Edit ref="openEditModal" />
          <v-icon small @click="openDeleteModal(item)"> mdi-delete </v-icon>
          <Delete ref="openDeleteModal" @get-admin-users="getUsers" />
        </template>
      </v-data-table>
    </v-card>
    <div class="text-center my-5">
      <v-pagination
        v-model="page"
        :length="lastPage"
        @input="getUsers"
      ></v-pagination>
    </div>
  </div>
</template>

<script>
export default {
  layout: "admin",
  components: {
    Create: () => import("@/components/admin/users/Create"),
    Edit: () => import("@/components/admin/users/Edit"),
    Delete: () => import("@/components/admin/users/Delete"),
  },
  data() {
    return {
      page: 1,
      lastPage: 1,
      perPage: 10,
      users: [],
      headers: [
        { text: "ID", align: "center", value: "id" },
        { text: "名前", align: "center", value: "name" },
        { text: "メールアドレス", align: "center", value: "email" },
        { text: "操作", align: "center", value: "action", sortable: false },
      ],
      loading: true,
      dialog: false,
    };
  },
  async created() {
    this.getUsers(this.page);
  },
  methods: {
    async getUsers(page) {
      this.$axios
        .$get("users", { params: { page: parseInt(page) } })
        .then((res) => {
          this.loading = false;

          this.perPage = res.data.per_page;
          this.lastPage = res.data.last_page;
          this.users = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    close() {
      this.dialog = false;
    },
    openEditModal(item) {
      this.$refs.openEditModal.open(item);
    },
    openDeleteModal(item) {
      this.$refs.openDeleteModal.open(item);
    },
  },
};
</script>
