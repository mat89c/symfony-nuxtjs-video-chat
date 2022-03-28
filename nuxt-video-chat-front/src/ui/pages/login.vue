<template>
  <v-container class="fill-height">
    <v-row class="justify-center">
      <v-col
        cols="12"
        class="d-flex align-center align-content-center flex-column"
      >
        <h1>
          Zaloguj się
        </h1>

        <UserLogin />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import UserLogin from './../../app/modules/userLogin/ui/UserLogin.vue'

export default {
  layout: 'guest',
  auth: 'guest',
  head () {
    return {
      title: 'Logowanie'
    }
  },
  components: {
    UserLogin
  }
}
</script>
