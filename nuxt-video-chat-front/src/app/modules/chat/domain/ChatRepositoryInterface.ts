import ChatMessage from "./ChatMessage";

export default interface ChatRepositoryInterface {
   addMessage(message: ChatMessage): void
   getMessages(): ChatMessage[]
}