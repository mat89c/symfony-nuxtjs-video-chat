import { Module, GetterTree, ActionTree, MutationTree } from 'vuex'
import RootStateInterface from '~/src/ui/store/RootStateInterface';
import ChatMessage from '../../domain/ChatMessage';
import ChatStoreStateInterface from './ChatStoreStateInterface';

export default class ChatStore implements Module<ChatStoreStateInterface, RootStateInterface> {
    public namespaced = true

    public state: ChatStoreStateInterface = {
        messages: [],
        currentChatChannelId: ''
    }

    public getters: GetterTree<ChatStoreStateInterface, RootStateInterface> = {
        getMessages(state: ChatStoreStateInterface): ChatMessage[] {
            return state.messages
        },

        getCurrentChatChannelId(state: ChatStoreStateInterface): string {
            return state.currentChatChannelId
        }
    }

    public actions: ActionTree<ChatStoreStateInterface, RootStateInterface> = {
        addMessage({ commit }, message: string) {
            commit('ADD_MESSAGE', message)
        },

        setCurrentChatChannelId({ commit }, chatId: string) {
            commit('SET_CURRENT_CHAT_CHANNEL_ID', chatId)
        },
        
        loadChatChannelMessages({ commit }, chatMessages: ChatMessage[]) {
            commit('LOAD_CHAT_CHANNEL_MESSAGES', chatMessages)
        },

        loadOlderChatChannelMessages({ commit }, chatMessages: ChatMessage[]) {
            commit('LOAD_OLDER_CHAT_CHANNEL_MESSAGES', chatMessages)
        }
    }

    public mutations: MutationTree<ChatStoreStateInterface> = {
        ADD_MESSAGE(state: ChatStoreStateInterface, message: ChatMessage) {
            state.messages.push(message)
        },

        SET_CURRENT_CHAT_CHANNEL_ID(state: ChatStoreStateInterface, chatId: string) {
            state.currentChatChannelId = chatId
        },

        LOAD_CHAT_CHANNEL_MESSAGES(state: ChatStoreStateInterface, chatMessages: ChatMessage[]) {
            state.messages = chatMessages
        },

        LOAD_OLDER_CHAT_CHANNEL_MESSAGES(state: ChatStoreStateInterface, chatMessages: ChatMessage[]) {
            const newChatMessages = chatMessages.concat(state.messages)
            state.messages = newChatMessages
        }
    }
}