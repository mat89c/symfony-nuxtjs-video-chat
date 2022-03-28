import Vue from 'vue'

declare module 'vue/types/vue' {
  interface Vue {
    $rules: object
  }
}

Vue.prototype.$rules = {
  required: [
    (v: string): boolean | string => !!v || 'Pole jest wymagane.'
  ],
  email: [
    (v: string): boolean | string => /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'Nieprawidłowy adres e-mail.'
  ]
}