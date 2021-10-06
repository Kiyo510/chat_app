<template>
  <div>
    <h1>管理画面</h1>
    <NuxtLink to="/admin/link">link</NuxtLink>
  </div>
</template>

<script>
export default {
  middleware: "not_logined_admin_user",
};
</script>
