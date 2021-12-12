<template>
  <div>
    <v-btn color="red white--text" @click="deleteData"> 削除 </v-btn>
  </div>
</template>
<script>
export default {
  methods: {
    deleteData() {
      this.$emit("delete-data");
    },
  },
};
</script>
