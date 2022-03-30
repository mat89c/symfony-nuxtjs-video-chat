import { Module, GetterTree, ActionTree, MutationTree } from 'vuex'
import RootStateInterface from '~/src/ui/store/RootStateInterface';
import ChatMessage from '../../domain/ChatMessage';
import ChatStoreStateInterface from './ChatStoreStateInterface';

export default class ChatStore implements Module<ChatStoreStateInterface, RootStateInterface> {
    public namespaced = true

    public state: ChatStoreStateInterface = {
        messages: []
    }

    public getters: GetterTree<ChatStoreStateInterface, RootStateInterface> = {
        getMessages(state: ChatStoreStateInterface): ChatMessage[] {
            return state.messages
        }
    }

    public actions: ActionTree<ChatStoreStateInterface, RootStateInterface> = {
        addMessage({ commit }, message: string) {
            commit('ADD_MESSAGE', message)
        }
    }

    public mutations: MutationTree<ChatStoreStateInterface> = {
        ADD_MESSAGE(state: ChatStoreStateInterface, message: ChatMessage) {
            state.messages.push(message)
        }
    }
}