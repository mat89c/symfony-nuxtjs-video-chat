<template>
  <div>
    <v-row class="pt-5">
      <v-col cols="3">
        <ChatChannels 
          @scrollChat="scrollChat"
          @showInfiniteScroll="showInfiniteScroll"
        />
      </v-col>

      <v-col cols="6">
        <v-card elevation="2">
          <v-card-text id="chat-content" class="d-block chat-window">
            <ChatMessagesInfiniteScroll 
              v-if="infiniteScroll"
            />
            
            <div
              v-for="(message, index) in messages"
              :key="index"
              class="chat-row mt-4"
            >
              <div class="d-flex mb-3">
                <v-avatar color="indigo" size="36" class="mr-2">
                  <span class="white--text">{{ message.authorInitials }}</span>
                </v-avatar>

                <div>
                  <div class="mr-2">
                    <small>{{ message.authorName }}</small>
                    <small>{{ message.dateAsString }}</small>
                  </div>
                  <div>{{ message.content }}</div>
                </div>
              </div>
            </div>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="3">
        <v-card elevation="2" class="chat-window">
          <v-card-text>
            <div v-for="(item, index) in users" :key="index">
              {{ item.name }}

              <v-btn small icon @click="onCall(item.name, item.socketId)">
                <v-icon small> mdi-phone </v-icon>
              </v-btn>
            </div>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12">
        <div class="d-flex flex-row align-center">
          <v-text-field
            v-model="message.content"
            placeholder="Type something"
            @keypress.enter="onSendMessage"
          />
          <v-btn icon class="ml-4" @click="onSendMessage">
            <v-icon> mdi-send </v-icon>
          </v-btn>
        </div>
      </v-col>
    </v-row>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component';
import ChatRepository from '../infrastructure/repository/ChatRepository'
import ChatRepositoryInterface from '../domain/ChatRepositoryInterface'
import SendMessageCommand from '../application/sendMessage/command/SendMessageCommand'
import AppendMessageToChatCommand from '../application/appendeMessageToChat/command/AppendMessageToChatCommand'
import CommandInterface from '../../../../shared/application/command/CommandInterface'
import GetMessagesQuery from '../application/getMessages/query/GetMessagesQuery'
import QueryInterface from '../../../../shared/application/query/QueryInterface'
import ChatMessageDataInterface from '../domain/ChatMessageDataInterface';
import ChatMessage from '../domain/ChatMessage';
import NuxtSocketIO from '../../../../shared/infrastructure/socket/NuxtSocketIO'
import SocketInterface from '../../../../shared/infrastructure/socket/SocketInterface'
import AxiosService from '../../../../shared/infrastructure/http/AxiosService'
import HttpInterface from '../../../../shared/infrastructure/http/HttpInterface'
import ChatChannels from './ChatChannels.vue'
import ChatMessagesInfiniteScroll from './ChatMessagesInfiniteScroll.vue'

@Component({
  components: {
    ChatChannels,
    ChatMessagesInfiniteScroll
  }
})
export default class Chat extends Vue {
  private chatRepository: ChatRepositoryInterface
  private http: HttpInterface
  private socket: SocketInterface
  private message: ChatMessageDataInterface = {
    chatId: '',
    authorName: this.$auth!.user!.username as string,
    content: '',
    createdAt: null
  }
  private infiniteScroll: boolean = false

  private users = []

  constructor() {
    super()
    this.http = new AxiosService(this.$axios)
    this.socket = new NuxtSocketIO(this.$nuxtSocket({ name: 'chat', channel: '/', reconnection: false })) 
    this.chatRepository = new ChatRepository(this.$store, this.socket, this.http) 
  }

  public mounted() {
    this.socket.on('send-message', (message: ChatMessageDataInterface) => {
      const appendMessageToChatCommand: CommandInterface = new AppendMessageToChatCommand(this.chatRepository, message)
      appendMessageToChatCommand.execute()

      this.scrollChat()
    })
  }

  get messages(): ChatMessage[] {
    const getMessagesQuery: QueryInterface<ChatMessage[]> = new GetMessagesQuery(this.chatRepository)
    return getMessagesQuery.query()
  }

  public onSendMessage(): void {
    const sendMessageCommand: CommandInterface = new SendMessageCommand(this.chatRepository, this.message)
    sendMessageCommand.execute()
    
    this.scrollChat()
  }

  public scrollChat(): void {
    setTimeout(() => {
      const chatContent: HTMLDivElement = this.$el.querySelector('#chat-content') as HTMLDivElement
      chatContent.scrollTop = chatContent.scrollHeight
    }, 50)
  }

  public showInfiniteScroll(): void {
    this.infiniteScroll = true
  }
}
</script>

<style lang="scss">
.chat-window {
  height: calc(100vh - 200px);
  overflow: auto;
}

.chat-row {
  width: 100%;
  border-bottom: 1px dotted rgb(94, 94, 94);
  margin-bottom: 15px;

  &:last-child {
    border-bottom: none;
  }
}
</style>