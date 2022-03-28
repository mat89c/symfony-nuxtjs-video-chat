import CommandInterface from "~/src/shared/application/command/CommandInterface";
import Notification from "../../../domain/Notification";
import NotificationDataInterface from "../../../domain/NotificationDataInterface";
import NotificationRepositoryInterface from "../../../domain/NotificationRepositoryInterface";

export default class SetNotificationCommand implements CommandInterface {
    private data: NotificationDataInterface
    private notificationRepository: NotificationRepositoryInterface

    constructor(data: NotificationDataInterface, notificationRepository: NotificationRepositoryInterface) {
        this.data = data
        this.notificationRepository = notificationRepository
    }

    public execute(): void {
        const notification = new Notification(this.data)

        this.notificationRepository.setNotification(notification)
    }
}