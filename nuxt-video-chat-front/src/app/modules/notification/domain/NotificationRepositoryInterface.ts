import Notification from "./Notification";
import NotificationDataInterface from "./NotificationDataInterface";

export default interface NotificationRepositoryInterface { 
    setNotification(notification: Notification): void 
    getNotificationData(): NotificationDataInterface
}