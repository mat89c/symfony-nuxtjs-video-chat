import ChatMessageDataInterface from "./ChatMessageDataInterface"

export default class ChatMessage {
    private chatId: string
    private authorName: string
    private authorInitials: string
    private content: string
    private date: Date
    private dateAsString: string

    constructor(data: ChatMessageDataInterface) {
        this.chatId = data.chatId
        this.authorName = data.authorName
        this.authorInitials = this.authorName[0].toUpperCase()
        this.content = data.content
        this.date = data.createdAt ? new Date(data.createdAt) : new Date()
        this.dateAsString = `${this.date.toLocaleTimeString()} ${this.date.toLocaleDateString()}` 
    }

    public getChatId(): string {
        return this.chatId
    }

    public getAuthorName(): string {
        return this.authorName
    }
    
    public getAuthorInitials(): string {
        return this.authorInitials
    }

    public getContent(): string {
        return this.content
    }

    public getDate(): Date {
        return this.date
    }

    public getDateAsString(): string {
        return this.dateAsString
    }
}