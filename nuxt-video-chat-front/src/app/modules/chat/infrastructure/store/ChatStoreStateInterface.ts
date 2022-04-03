import ChatMessage from "../../domain/ChatMessage";

export default interface ChatStoreStateInterface {
    messages: ChatMessage[],
    currentChatChannelId: string
}