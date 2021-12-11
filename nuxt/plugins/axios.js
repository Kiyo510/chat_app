export default function ({ $axios, store }) {
  $axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

  $axios.interceptors.response.use(function (response) {
    store.dispatch('loading/loadingStop');
    return response;
  });

  $axios.onError((error) => {
    if (error.response.status === 422) {
      store.dispatch('validation/setErrors', error.response.data.error.message)
    }
    store.dispatch('loading/loadingStop');
    return Promise.reject(error)
  })

  $axios.onRequest(() => {
    store.dispatch('validation/clearErrors')
    store.dispatch('loading/loadingStart');
  })
}
