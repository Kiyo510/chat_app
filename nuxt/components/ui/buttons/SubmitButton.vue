<template>
  <div>
    <v-btn :color="color" @click="save">{{ text }}</v-btn>
  </div>
</template>
<script>
export default {
  props: {
    color: {
      type: String,
      required: true,
    },
    text: {
      type: String,
      required: true,
    },
  },
  methods: {
    save() {
      this.$emit("click");
    },
  },
};
</script>
