import Notification from "~/src/app/modules/notification/domain/Notification"
import { mockNotificationData } from './NotificationData.mock'

describe('Notification', () => {
    describe('constructor', () => {
        it('should create instnce with data', () => {
            const notification = new Notification(mockNotificationData)
            expect(notification).toBeInstanceOf(Notification)
        })
        
        it('should return visibility', () => {
            const notification = new Notification(mockNotificationData)
            expect(notification.getVisibility()).toBeFalsy()
        })
    })
})