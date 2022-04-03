import CommandInterface from "~/src/shared/application/command/CommandInterface";
import ChatMessage from "../../../domain/ChatMessage";
import ChatMessageDataInterface from "../../../domain/ChatMessageDataInterface";
import ChatRepositoryInterface from "../../../domain/ChatRepositoryInterface";

export default class LoadChatChannelMessages implements CommandInterface {
    private messages: ChatMessageDataInterface[]
    private chatRepository: ChatRepositoryInterface

    constructor(messages: ChatMessageDataInterface[], chatRepository: ChatRepositoryInterface) {
        this.messages = messages
        this.chatRepository = chatRepository
    }

    public execute(): void {
        if (!this.messages) {
            return;
        }
        
        const chatMessages = this.messages.map((message) => {
            return new ChatMessage(message)
        })

        this.chatRepository.loadChatChannelMessages(chatMessages);
    }
}