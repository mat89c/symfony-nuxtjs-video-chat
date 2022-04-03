import QueryInterface from "~/src/shared/application/query/QueryInterface";
import ChatChannelDataInterface from "../../../domain/ChatChannelDataInterface";
import ChatRepositoryInterface from "../../../domain/ChatRepositoryInterface";

export default class GetChatChannelsQuery implements QueryInterface<Promise<ChatChannelDataInterface[]>> {
    private chatRepository: ChatRepositoryInterface 

    constructor(chatRepository: ChatRepositoryInterface) {
        this.chatRepository = chatRepository
    }

    public async query(): Promise<ChatChannelDataInterface[]> {
        return await this.chatRepository.getChatChannels() 
    }
}