import ChatRepositoryInterface from "../../domain/ChatRepositoryInterface";
import { Store } from 'vuex'
import ChatMessage from "../../domain/ChatMessage";

export default class ChatRepository implements ChatRepositoryInterface {
    private store: Store<any> 

    constructor(store: Store<any>) {
        this.store = store
    }

    public addMessage(message: ChatMessage): void {
        this.store.dispatch('chatStore/addMessage', message)
    }

    public getMessages(): ChatMessage[] {
        return this.store.getters['chatStore/getMessages']
    }
} 