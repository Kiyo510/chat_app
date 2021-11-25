export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: "nuxt",
    htmlAttrs: {
      lang: "ja"
    },
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "" },
      { name: "format-detection", content: "telephone=no" }
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "" }]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    "~/plugins/axios",
    '@plugins/vee-validate',
    '@plugins/mixins/validation.js'
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: ['@nuxtjs/vuetify'],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    "@nuxtjs/axios",
    "@nuxtjs/proxy",
    '@nuxtjs/toast',
  ],

  toast: {
    position: 'top-right',
    register: [
      {
        name: 'success_message',
        message: (payload) => {
          if (!payload.message) return '更新しました'
          return payload.message
        },
        options: {
          type: 'success',
          duration: 3000,
          className: ['toast-success'],
        },
      },
    ],
  },

  axios: {
    credentials: true
  },

  // proxy: {
  //   "/api/": process.env.BROWSER_URL || "http://localhost:10081"
  // },

  publicRuntimeConfig: {
    axios: {
      browserBaseURL: process.env.BROWSER_BASE_URL
    }
  },

  privateRuntimeConfig: {
    axios: {
      baseURL: process.env.API_URL
    }
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: [
      'vee-validate/dist/rules'
    ]
  }
};
