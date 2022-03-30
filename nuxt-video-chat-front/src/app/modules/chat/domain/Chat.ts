import ChatMessage from "./ChatMessage"

export default class Chat {
    private messages: Array<ChatMessage> = []

    public addMessage(message: ChatMessage) {
        this.messages.push(message)
    }
}