import ChatRepositoryInterface from "../../domain/ChatRepositoryInterface";
import { Store } from 'vuex'
import ChatMessage from "../../domain/ChatMessage";
import SocketInterface from "~/src/shared/infrastructure/socket/SocketInterface";
import HttpInterface from "~/src/shared/infrastructure/http/HttpInterface";
import ChatChannelDataInterface from "../../domain/ChatChannelDataInterface";
import ChatMessageDataInterface from "../../domain/ChatMessageDataInterface";

export default class ChatRepository implements ChatRepositoryInterface {
    private store: Store<any> 
    private socket: SocketInterface
    private http: HttpInterface

    constructor(store: Store<any>, socket: SocketInterface, http: HttpInterface) {
        this.store = store
        this.socket = socket
        this.http = http
    }  

    public addMessage(message: ChatMessage): void {
        this.store.dispatch('chatStore/addMessage', message)
        this.socket.emit('send-message', message)
        this.http.post<object>('/api/chat/add-message', {
            chatId: message.getChatId(),
            message: message.getContent()
        })
    }

    public setCurrentChatChannel(chatId: string): void {
        this.store.dispatch('chatStore/setCurrentChatChannelId', chatId)
    }

    public getCurrentChatChannelId(): string {
        return this.store.getters['chatStore/getCurrentChatChannelId']
    }

    public getMessages(): ChatMessage[] {
        return this.store.getters['chatStore/getMessages']
    }

    public async getChatChannels(): Promise<ChatChannelDataInterface[]> {
        return await this.http.get<any>('/api/chat/get-chat-channels') 
            .then(({ data }) => data )
    } 

    public async fetchChatMessagesById(chatChannelId: string, page: number = 1): Promise<ChatMessageDataInterface[]> {
        return await this.http.get<any>('/api/chat/fetch-chat-messages-by-id', {
            params:{
                id: chatChannelId,
                page 
            }
        }).then(({ data }) => data)
    }

    public loadChatChannelMessages(chatMessages: ChatMessage[]): void {
        this.store.dispatch('chatStore/loadChatChannelMessages', chatMessages)
    }

    public loadOlderChatChannelMessages(chatMessages: ChatMessage[]): void {
        this.store.dispatch('chatStore/loadOlderChatChannelMessages', chatMessages)
    }

    public appendMessageToChat(message: ChatMessage): void {
        this.store.dispatch('chatStore/addMessage', message)
    }
} 