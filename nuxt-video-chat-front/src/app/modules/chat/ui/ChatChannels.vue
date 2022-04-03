<template>
  <v-card elevation="2" class="chat-window">
    <v-card-text>
      <div v-for="(channel, index) in channels" :key="index">
        <v-btn small text @click="onClick(channel.id)">
          #{{ channel.name }}
        </v-btn>
      </div>
    </v-card-text>
  </v-card>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import GetChatChannelsQuery from '../application/getChatChannels/query/GetChatChannelsQuery'
import FetchChatMessagesByIdQuery from '../application/fetchChatMessagesById/query/FetchChatMessagesByIdQuery'
import QueryInterface from '../../../../shared/application/query/QueryInterface'
import AxiosService from '../../../../shared/infrastructure/http/AxiosService'
import HttpInterface from '../../../../shared/infrastructure/http/HttpInterface'
import NuxtSocketIO from '../../../../shared/infrastructure/socket/NuxtSocketIO'
import SocketInterface from '../../../../shared/infrastructure/socket/SocketInterface'
import ChatChannelDataInterface from '../domain/ChatChannelDataInterface'
import ChatRepositoryInterface from '../domain/ChatRepositoryInterface'
import ChatRepository from '../infrastructure/repository/ChatRepository'
import SetCurrentChatChannel from '../application/setCurrentChatChannel/command/SetCurrentChatChannel'
import CommandInterface from '../../../../shared/application/command/CommandInterface'
import ChatMessageDataInterface from '../domain/ChatMessageDataInterface'
import LoadChatChannelMessages from '../application/loadChatChannelMessages/command/LoadChatChannelMessages'


@Component
export default class ChatChannels extends Vue {
  private channels: ChatChannelDataInterface[] = []
  private chatRepository: ChatRepositoryInterface
  private socket: SocketInterface
  private http: HttpInterface

  constructor() {
    super()
    this.http = new AxiosService(this.$axios)
    this.socket = new NuxtSocketIO(this.$nuxtSocket({ name: 'chat', channel: '/', reconnection: false })) 
    this.chatRepository = new ChatRepository(this.$store, this.socket, this.http)
  }

  public mounted(): void {
    const getChatChannelsQuery: QueryInterface<Promise<ChatChannelDataInterface[]>> = new GetChatChannelsQuery(this.chatRepository)
    getChatChannelsQuery.query().then((data) => {
      this.channels = data
      
      if (this.channels.length) {
        const setCurrentChatChannelCommand: CommandInterface = new SetCurrentChatChannel(this.chatRepository, this.channels[0].id)
        setCurrentChatChannelCommand.execute()
        
        const fetchChatMessagesByIdQuery: QueryInterface<Promise<ChatMessageDataInterface[]>> = new FetchChatMessagesByIdQuery(this.chatRepository)
        fetchChatMessagesByIdQuery.query().then((data) => {
          const chatMessages = data

          const loadChatChannelMessages: CommandInterface = new LoadChatChannelMessages(chatMessages, this.chatRepository) 
          loadChatChannelMessages.execute()

          this.$emit('scrollChat')
          const that = this
          
          setTimeout(function() {
            that.$emit('showInfiniteScroll')
          }, 500)
        })

      }
    })
  }
}
</script>
