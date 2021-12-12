<template>
  <div v-if="Object.keys(validationErrors).length > 0">
    <v-alert
      v-for="(value, key) in validationErrors"
      :key="key"
      type="error"
      :width="width"
      :class="alertClass"
    >
      {{ value[0] }}
    </v-alert>
  </div>
</template>
<script>
export default {
  props: {
    width: {
      type: String,
      required: true,
    },
    alertClass: {
      type: String,
      required: true,
    },
  },
};
</script>
