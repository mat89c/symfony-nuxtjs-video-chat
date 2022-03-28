<template>
  <v-snackbar v-model="visibility" top right :color="notification.bgColor">
    {{ notification.message }}
  </v-snackbar>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import NotificationRepository from '../infrastructure/repository/NotificationRepository'
import NotificationRepositoryInterface from '../domain/NotificationRepositoryInterface'
import GetNotificationQuery from '../application/getNotification/query/GetNotificationQuery'
import QueryInterface from '../../../../shared/application/query/QueryInterface'
import Notification from '../domain/Notification'
import SetNotificationCommand from '../application/setNotification/command/SetNotificationCommand'
import CommandInterface from '../../../../shared/application/command/CommandInterface'

@Component
export default class NotificationBar extends Vue {
  private notificationRepository: NotificationRepositoryInterface

  constructor() {
    super()

    this.notificationRepository = new NotificationRepository(this.$store)
  }

  get visibility(): boolean {
    const getNotificationQuery: QueryInterface<Notification> = new GetNotificationQuery(this.notificationRepository)
    const notification: Notification = getNotificationQuery.query()

    return notification.getVisibility()
  }
  
  set visibility(value: boolean) {
    const setNotificationCommand: CommandInterface =
        new SetNotificationCommand(
        {
            message: '',
            visibility: false,
            bgColor: 'red'
        },
        this.notificationRepository
    )

    setNotificationCommand.execute()
  }

  get notification(): Notification {
    const getNotificationQuery: QueryInterface<Notification> = new GetNotificationQuery(this.notificationRepository)
    const notification: Notification = getNotificationQuery.query()

    return notification
  }
}
</script>