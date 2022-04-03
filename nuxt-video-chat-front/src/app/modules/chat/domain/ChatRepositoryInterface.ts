import ChatChannelDataInterface from "./ChatChannelDataInterface";
import ChatMessage from "./ChatMessage";
import ChatMessageDataInterface from "./ChatMessageDataInterface";

export default interface ChatRepositoryInterface {
   addMessage(message: ChatMessage): void
   setCurrentChatChannel(chatId: string): void
   getMessages(): ChatMessage[]
   getChatChannels(): Promise<ChatChannelDataInterface[]>
   getCurrentChatChannelId(): string
   fetchChatMessagesById(chatChannelId: string, page?: number): Promise<ChatMessageDataInterface[]>
   loadChatChannelMessages(chatMessages: ChatMessage[]): void
   loadOlderChatChannelMessages(chatMessages: ChatMessage[]): void
   appendMessageToChat(message: ChatMessage): void
}