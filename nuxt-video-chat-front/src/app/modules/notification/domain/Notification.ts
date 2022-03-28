import NotificationDataInterface from "./NotificationDataInterface"

export default class Notification {
    private message: string
    private visibility: boolean = false
    private bgColor: string = 'green'

    constructor(data: NotificationDataInterface) {
        this.message = data.message
        this.visibility = data.visibility
        this.bgColor = data.bgColor
    }

    public getMessage(): string {
        return this.message
    }
    
    public getVisibility(): boolean {
        return this.visibility
    }

    public getBgColor(): string {
        return this.bgColor
    }
}