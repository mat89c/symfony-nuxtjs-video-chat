<template>
  <v-card v-if="show" v-intersect="infiniteScrolling">
    <v-progress-linear indeterminate></v-progress-linear>
  </v-card>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import LoadOlderChatChannelMessages from '../application/loadOlderChatChannelMessages/command/LoadOlderChatChannelMessagesCommand'
import CommandInterface from '../../../../shared/application/command/CommandInterface'
import QueryInterface from '../../../../shared/application/query/QueryInterface'
import ChatMessageDataInterface from '../domain/ChatMessageDataInterface'
import AxiosService from '../../../../shared/infrastructure/http/AxiosService'
import ChatRepositoryInterface from '../domain/ChatRepositoryInterface'
import NuxtSocketIO from '../../../../shared/infrastructure/socket/NuxtSocketIO'
import SocketInterface from '../../../../shared/infrastructure/socket/SocketInterface'
import ChatRepository from '../infrastructure/repository/ChatRepository'
import HttpInterface from '../../../../shared/infrastructure/http/HttpInterface'
import FetchChatMessagesByIdQuery from '../application/fetchChatMessagesById/query/FetchChatMessagesByIdQuery'

@Component
export default class ChatMessagesInfiniteScroll extends Vue {
  private show: boolean = true
  private scrollLoading: boolean = false
  private page: number = 1
  private chatRepository: ChatRepositoryInterface
  private socket: SocketInterface
  private http: HttpInterface

  constructor() {
    super()
    this.http = new AxiosService(this.$axios)
    this.socket = new NuxtSocketIO(
      this.$nuxtSocket({ name: 'chat', channel: '/', reconnection: false })
    )
    this.chatRepository = new ChatRepository(
      this.$store,
      this.socket,
      this.http
    )
  }

  public infiniteScrolling(entries, observer, isIntersecting) {
    if (!this.scrollLoading && isIntersecting) {
      this.scrollLoading = true
      this.page++

      const fetchChatMessagesByIdQuery: QueryInterface<Promise<ChatMessageDataInterface[]>> = new FetchChatMessagesByIdQuery(this.chatRepository, this.page)
      fetchChatMessagesByIdQuery.query().then((data) => {
        const chatMessages = data 

        const loadOlderChatChannelMessages: CommandInterface = new LoadOlderChatChannelMessages(chatMessages, this.chatRepository)
        loadOlderChatChannelMessages.execute()
      })
    }
  }
}
</script>
