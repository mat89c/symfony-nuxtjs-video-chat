<template>
  <v-app dark>
    <v-app-bar
      app
      dense
    >
      <v-spacer />

      <v-btn
        text
        @click="onClickLogout" 
      >
        Wyloguj się
      </v-btn>
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

<script lang="ts">
import UserSession from '../../app/modules/userSession/ui/UserSession.vue'
import Notification from '../../app/modules/notification/ui/NotificationBar.vue'

export default {
  name: 'DefaultLayout',
  middleware: 'auth',
  components: {
    UserSession,
    Notification
  },
  methods: {
    onClickLogout() {
      this.$auth.logout()
      this.$router.push('/login')
    }
  }
}
</script>
