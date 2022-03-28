import { GetterTree, Module, MutationTree, ActionTree } from 'vuex'
import RootStateInterface from '~/src/ui/store/RootStateInterface'
import NotificationStoreStateInterface from './NotificationStoreStateInterface'
import Notification from '../../domain/Notification'
import NotificationDataInterface from '../../domain/NotificationDataInterface'

export default class NotificationStore implements Module<NotificationStoreStateInterface, RootStateInterface> {
    public namespaced = true

    public state: NotificationStoreStateInterface = {
        visibility: false, 
        message: '',
        bgColor: 'green'
    }

    public getters: GetterTree<NotificationStoreStateInterface, RootStateInterface> = {
        getNotificationData(state: NotificationStoreStateInterface): NotificationDataInterface {
            return {
                message: state.message,
                visibility: state.visibility,
                bgColor: state.bgColor
            }
        }
    }

    public actions: ActionTree<NotificationStoreStateInterface, RootStateInterface> = {
        setNotification({ commit }, notification: Notification) {
            commit('SET_NOTIFICATION', notification)
        }
    }

    public mutations: MutationTree<NotificationStoreStateInterface> = {
        SET_NOTIFICATION(state: NotificationStoreStateInterface, notification: Notification): void {
            state.visibility = notification.getVisibility()
            state.message = notification.getMessage()
            state.bgColor = notification.getBgColor()
        }
    }
}
