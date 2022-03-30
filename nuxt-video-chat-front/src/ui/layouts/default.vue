<template>
  <v-app dark>
    <v-app-bar
      app
      dense
    >
      <v-spacer />

      <UserLogout />
    </v-app-bar>

    <v-main>
      <v-container>
        <Nuxt />

        <UserSession />
        <Notification />
      </v-container>
    </v-main>
  </v-app>
</template>

<script> 
import UserSession from '../../app/modules/userSession/ui/UserSession.vue'
import Notification from '../../app/modules/notification/ui/NotificationBar.vue'
import UserLogout from '../../app/modules/userLogin/ui/UserLogout.vue'

export default {
  name: 'DefaultLayout',
  middleware: 'auth',
  components: {
    UserSession,
    Notification,
    UserLogout
  }
}
</script>
