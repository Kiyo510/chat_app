<template>
  <v-card width="980px" class="mx-auto mt-15">
    <v-data-table
      :headers="headers"
      :items="admins"
      :items-per-page="10"
      :loading="loading"
      loading-text="Loading... Please wait"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>管理者管理</v-toolbar-title>
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
              :get-admin-users="getAdminUsers"
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
        <Delete ref="openDeleteModal" @get-admin-users="getAdminUsers" />
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
export default {
  layout: "admin",
  components: {
    Create: () => import("@/components/admin/admin/Create"),
    Edit: () => import("@/components/admin/admin/Edit"),
    Delete: () => import("@/components/admin/admin/Delete"),
  },
  data() {
    return {
      admins: [],
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
    this.getAdminUsers();
  },
  methods: {
    async getAdminUsers() {
      this.$axios
        .$get("admins")
        .then((res) => {
          this.loading = false;
          this.admins = res.data;
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
