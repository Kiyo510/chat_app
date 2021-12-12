<template>
  <div>
    <v-btn :color="color" @click="open">{{ text }}</v-btn>
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
    open() {
      this.$emit("open-modal");
    },
  },
};
</script>
