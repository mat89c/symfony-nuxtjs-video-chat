import QueryInterface from "~/src/shared/application/query/QueryInterface";
import Notification from "../../../domain/Notification";
import NotificationDataInterface from "../../../domain/NotificationDataInterface";
import NotificationRepositoryInterface from "../../../domain/NotificationRepositoryInterface";

export default class GetNotificationQuery implements QueryInterface<Notification> {
    private notificationRepository: NotificationRepositoryInterface

    constructor(notificationRepository: NotificationRepositoryInterface) {
        this.notificationRepository = notificationRepository
    }
    
    public query(): Notification {
        const data: NotificationDataInterface = this.notificationRepository.getNotificationData()
        return new Notification(data)
    }
}