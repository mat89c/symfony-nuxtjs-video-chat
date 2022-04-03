import CommandInterface from "~/src/shared/application/command/CommandInterface";
import ChatMessage from "../../../domain/ChatMessage";
import ChatMessageDataInterface from "../../../domain/ChatMessageDataInterface";
import ChatRepositoryInterface from "../../../domain/ChatRepositoryInterface";

export default class SendMessageCommand implements CommandInterface {
    private chatRepository: ChatRepositoryInterface
    private message: ChatMessageDataInterface

    constructor(chatRepository: ChatRepositoryInterface, message: ChatMessageDataInterface) {
        this.chatRepository = chatRepository
        this.message = message
    }

    public execute(): void {
        this.message.chatId = this.chatRepository.getCurrentChatChannelId()
        const chatMessage = new ChatMessage(this.message)
        this.chatRepository.addMessage(chatMessage)
        this.message.content = ''
    }
}