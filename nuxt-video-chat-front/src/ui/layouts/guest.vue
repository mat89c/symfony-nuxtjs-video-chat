<template>
  <v-app>
    <v-app-bar
      app
      dense
    >
    </v-app-bar>

    <v-main>
      <nuxt />

      <NotificationBar />
    </v-main>
  </v-app>
</template>

<script>
import NotificationBar from '../../app/modules/notification/ui/NotificationBar.vue'

export default {
  middleware: 'auth',
  auth: 'guest',
  components: {
    NotificationBar
  }
}
</script>
