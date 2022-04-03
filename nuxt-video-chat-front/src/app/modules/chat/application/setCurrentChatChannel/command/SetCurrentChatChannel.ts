import CommandInterface from "~/src/shared/application/command/CommandInterface";
import ChatRepositoryInterface from "../../../domain/ChatRepositoryInterface";

export default class SetCurrentChatChannel implements CommandInterface {
    private chatRepository: ChatRepositoryInterface
    private chatId: string
    
    constructor(chatRepository: ChatRepositoryInterface, chatId: string) {
        this.chatRepository = chatRepository
        this.chatId = chatId
    }

    public execute(): void {
        this.chatRepository.setCurrentChatChannel(this.chatId)
    }
}