<template>
  <v-btn text @click="onClickLogout">Wyloguj się</v-btn>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import AuthInterface from '../../../../shared/infrastructure/auth/AuthInterface'
import AuthService from '../../../../shared/infrastructure/auth/AuthService'
import Router from '../../../../shared/infrastructure/router/Router'
import RouterInterface from '../../../../shared/infrastructure/router/RouterInterface'
import LogoutUserCommand from '../application/logoutUser/command/LogoutUserCommand'
import CommandInterface from '../../../../shared/application/command/CommandInterface'

@Component
export default class UserLogout extends Vue {
  private auth: AuthInterface
  private router: RouterInterface

  constructor() {
    super()
    this.auth = new AuthService(this.$auth)
    this.router = new Router(this.$router)
  }

  public onClickLogout(): void {
      const logoutUserCommand: CommandInterface = new LogoutUserCommand(this.auth, this.router)
      logoutUserCommand.execute()
  }
}
</script>
