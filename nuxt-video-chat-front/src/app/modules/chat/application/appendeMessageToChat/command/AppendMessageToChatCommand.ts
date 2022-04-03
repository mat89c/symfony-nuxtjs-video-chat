import CommandInterface from "~/src/shared/application/command/CommandInterface";
import ChatMessage from "../../../domain/ChatMessage";
import ChatMessageDataInterface from "../../../domain/ChatMessageDataInterface";
import ChatRepositoryInterface from "../../../domain/ChatRepositoryInterface";

export default class AppendMessageToChatCommand implements CommandInterface {
    private chatRepository: ChatRepositoryInterface
    private message: ChatMessageDataInterface

    constructor(chatRepository: ChatRepositoryInterface, message: ChatMessageDataInterface) {
        this.chatRepository = chatRepository
        this.message = message
    }

    public execute(): void {
        const chatMessage = new ChatMessage(this.message)
        this.chatRepository.appendMessageToChat(chatMessage)
    }
}