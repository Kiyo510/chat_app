export default function({ store, redirect }) {
  if (!store.state.auth.admin_user) {
    redirect("/admin/login");
  }
}
