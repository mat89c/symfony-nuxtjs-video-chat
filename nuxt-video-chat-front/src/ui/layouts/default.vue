<template>
  <v-app dark>
      <v-app-bar
      app
      dense
      fixed
      :clipped-left="true"
    >
      <v-spacer />

      <UserLogout />
    </v-app-bar>

    <v-main>
      <v-container>
        <Nuxt />

        <UserSession />
        <NotificationBar />
      </v-container>
    </v-main>
  </v-app>
</template>

<script> 
import UserSession from '../../app/modules/userSession/ui/UserSession.vue'
import NotificationBar from '../../app/modules/notification/ui/NotificationBar.vue'
import UserLogout from '../../app/modules/userLogin/ui/UserLogout.vue'
import ChatChannels from '../../app/modules/chat/ui/ChatChannels.vue'
import ChatUsers from '../../app/modules/chat/ui/ChatUsers.vue'

export default {
  name: 'DefaultLayout',
  middleware: 'auth',
  components: {
    UserSession,
    NotificationBar,
    UserLogout,
    ChatChannels,
    ChatUsers
  }
}
</script>
