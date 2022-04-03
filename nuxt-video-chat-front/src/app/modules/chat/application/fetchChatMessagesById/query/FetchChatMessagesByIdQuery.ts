import QueryInterface from "~/src/shared/application/query/QueryInterface";
import ChatMessageDataInterface from "../../../domain/ChatMessageDataInterface";
import ChatRepositoryInterface from "../../../domain/ChatRepositoryInterface";

export default class FetchChatMessagesByIdQuery implements QueryInterface<Promise<ChatMessageDataInterface[]>> {
    private chatRepository: ChatRepositoryInterface
    private page: number

    constructor(chatRepository: ChatRepositoryInterface, page: number = 1) {
        this.chatRepository = chatRepository
        this.page = page
    }

    public async query(): Promise<ChatMessageDataInterface[]> {
        const chatId = this.chatRepository.getCurrentChatChannelId()
        return await this.chatRepository.fetchChatMessagesById(chatId, this.page)
    }
}