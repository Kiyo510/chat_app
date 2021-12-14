<template>
  <div>
    <v-card width="980px" class="mx-auto mt-8">
      <v-data-table
        :headers="headers"
        :items="users"
        :items-per-page="perPage"
        class="elevation-1"
        hide-default-footer
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>ユーザー管理</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-row justify="end" class="mr-1">
              <OpenModalButton
                :text="'新規登録'"
                :color="'primary'"
                @open-modal="openCreateModal"
              />
            </v-row>
            <Create
              ref="openCreateModal"
              @get-all-data="getUsers"
              @close-modal="close"
            />
          </v-toolbar>
        </template>
        <template v-slot:[`item.action`]="{ item }">
          <v-icon small class="mr-2" @click="openEditModal(item)">
            mdi-pencil
          </v-icon>
          <Edit ref="openEditModal" />
          <v-icon small @click="openDeleteModal(item)"> mdi-delete </v-icon>
          <DeleteComfirm
            ref="openDeleteModal"
            @get-all-data="getUsers"
            :endPoint="'users'"
          />
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
    Create: () => import("@/components/pages/admins/user/Create"),
    Edit: () => import("@/components/pages/admins/user/Edit"),
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
          this.perPage = res.data.per_page;
          this.lastPage = res.data.last_page;
          this.users = res.data.data;
        })
        .catch((err) => {
          console.error(err);
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
    openCreateModal() {
      this.$refs.openCreateModal.open();
    },
  },
};
</script>
