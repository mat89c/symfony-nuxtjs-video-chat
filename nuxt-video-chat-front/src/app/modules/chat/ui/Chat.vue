<template>
  <div>
    <v-row class="pt-5">
      <v-col cols="9">
        <v-card elevation="2">
          <v-card-text id="chat-content" class="d-block chat-window">
            <div
              v-for="(message, index) in messages"
              :key="index"
              class="chat-row"
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
import CommandInterface from '../../../../shared/application/command/CommandInterface'
import GetMessagesQuery from '../application/getMessages/query/GetMessagesQuery'
import QueryInterface from '../../../../shared/application/query/QueryInterface'
import ChatMessageDataInterface from '../domain/ChatMessageDataInterface';
import ChatMessage from '../domain/ChatMessage';
import NuxtSocketIO from '../../../../shared/infrastructure/socket/NuxtSocketIO'
import SocketInterface from '../../../../shared/infrastructure/socket/SocketInterface'

@Component
export default class Chat extends Vue {
  private chatRepository: ChatRepositoryInterface
  private message: ChatMessageDataInterface = {
    authorName: this.$auth!.user!.username as string,
    content: ''
  }

  private users = []
  private socket: SocketInterface

  constructor() {
    super()
    this.chatRepository = new ChatRepository(this.$store)
    this.socket = new NuxtSocketIO(this.$nuxtSocket({ name: 'chat', channel: '/', reconnection: false })) 
  }

  public mounted() {
    this.socket.on('send-message', (message: ChatMessageDataInterface) => {
      const sendMessageCommand: CommandInterface = new SendMessageCommand(this.chatRepository, message)
      sendMessageCommand.execute()

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
    
    this.socket.emit('send-message', this.message)
    this.message.content = ''

    this.scrollChat()
  }

  public scrollChat() {
    setTimeout(() => {
      const chatContent: HTMLDivElement = this.$el.querySelector('#chat-content') as HTMLDivElement
      chatContent.scrollTop = chatContent.scrollHeight
    }, 50)
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