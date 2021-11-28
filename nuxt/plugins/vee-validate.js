import Vue from 'vue'
import { ValidationProvider, ValidationObserver, extend, localize } from 'vee-validate'
import * as rules from 'vee-validate/dist/rules'
import ja from 'vee-validate/dist/locale/ja.json'

// すべてのバリデーションルールをインポート
Object.keys(rules).forEach((rule) => {
  extend(rule, rules[rule])

  if (rule === 'regex') {
    let regex = rules[rule]
    extend('regex', {
      ...regex,
      message: 'パスワードには大文字小文字数字をそれぞれ最低1つ以上含めてください。',
    })
  }
})



localize('ja', ja)

Vue.component('ValidationProvider', ValidationProvider)
Vue.component('ValidationObserver', ValidationObserver)
