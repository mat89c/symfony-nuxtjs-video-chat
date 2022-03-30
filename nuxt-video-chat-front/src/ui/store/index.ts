import Vue from 'vue'
import Vuex from 'vuex'
import UserSessionStore  from './../../app/modules/userSession/infrastructure/store/UserSessionStore'
import NotificationStore from '../../app/modules/notification/infrastructure/store/NotificationStore'
import ChatStore from '../../app/modules/chat/infrastructure/store/ChatStore'

Vue.use(Vuex)

const userSessionStore = new UserSessionStore()
const notificationStore = new NotificationStore()
const chatStore = new ChatStore()

export default () => new Vuex.Store({
    state: () => ({
    }),
    mutations: {},
    actions: {},
    modules: {
        userSessionStore,
        notificationStore,
        chatStore
    }
})