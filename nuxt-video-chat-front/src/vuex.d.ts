import { Auth } from '@nuxtjs/auth-next';
import { Store } from 'vuex'
import VueRouter from 'vue-router'

declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $store: Store<any>
    $auth: Auth
    $router: VueRouter 
  }
}