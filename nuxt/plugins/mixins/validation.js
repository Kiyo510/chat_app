import Vue from 'vue'
import { mapGetters } from 'vuex'

const Validation = {
  install(Vue) {
    Vue.mixin({
      computed: {
        ...mapGetters({
          validationErrors: 'validation/errors',
        }),
      },
    })
  },
}

Vue.use(Validation)
