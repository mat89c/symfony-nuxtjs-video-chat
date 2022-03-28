import Notification from "../../domain/Notification";
import NotificationRepositoryInterface from "../../domain/NotificationRepositoryInterface";
import { Store } from 'vuex'
import NotificationDataInterface from "../../domain/NotificationDataInterface";

export default class NotificationRepository implements NotificationRepositoryInterface {
    private store: Store<any>

    constructor(store: Store<any>) {
        this.store = store 
    }

    public setNotification(notification: Notification): void {
        this.store.dispatch('notificationStore/setNotification', notification)
    }

    public getNotificationData(): NotificationDataInterface {
        return this.store.getters['notificationStore/getNotificationData']
    }
}