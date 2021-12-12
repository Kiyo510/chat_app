<template>
  <v-card width="980px" class="mx-auto mt-15">
    <v-data-table
      :headers="headers"
      :items="admins"
      :items-per-page="10"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>管理者管理</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-row justify="end" class="mr-1">
            <OpenModalButton :text="'新規登録'" :color="'primary'" @open-modal="openCreateModal"/>
          </v-row>
          <Create
            ref="openCreateModal"
            @get-all-data="getAdminUsers"
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
          @get-all-data="getAdminUsers"
          :endPoint="'admins'"
        />
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
export default {
  layout: "admin",
  components: {
    Create: () => import("@/components/pages/admins/admin/Create"),
    Edit: () => import("@/components/pages/admins/admin/Edit"),
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
          this.admins = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
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
