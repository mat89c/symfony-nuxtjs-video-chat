import Vue from 'vue'
import Vuex from 'vuex'
import UserSessionStore  from './../../app/modules/userSession/infrastructure/store/UserSessionStore'
import NotificationStore from '../../app/modules/notification/infrastructure/store/NotificationStore'

Vue.use(Vuex)

const userSessionStore = new UserSessionStore()
const notificationStore = new NotificationStore()

export default () => new Vuex.Store({
    state: () => ({
    }),
    mutations: {},
    actions: {},
    modules: {
        userSessionStore,
        notificationStore
    }
})