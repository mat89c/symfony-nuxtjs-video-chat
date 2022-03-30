import QueryInterface from "~/src/shared/application/query/QueryInterface";
import ChatMessage from "../../../domain/ChatMessage";
import ChatRepositoryInterface from "../../../domain/ChatRepositoryInterface";

export default class GetMessagesQuery implements QueryInterface<ChatMessage[]> {
    private chatRepository: ChatRepositoryInterface

    constructor(chatRepository: ChatRepositoryInterface) {
        this.chatRepository = chatRepository
    }

    public query(): ChatMessage[] {
        return this.chatRepository.getMessages()
    }
}