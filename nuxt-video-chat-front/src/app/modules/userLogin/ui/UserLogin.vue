<template>
  <v-form ref="form" @submit.prevent="onSubmit">
    <v-text-field
      v-model="userData.email"
      label="E-mail"
      type="email"
      dense
      outlined
      :rules="$rules.email"
    />

    <v-text-field
      v-model="userData.password"
      label="Hasło"
      type="password"
      dense
      outlined
      :rules="$rules.required"
    />

    <v-btn block rounded type="submit">Zaloguj się</v-btn>
  </v-form>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import CommandInterface from '../../../../shared/application/command/CommandInterface'
import AuthInterface from '../../../../shared/infrastructure/auth/AuthInterface'
import AuthService from '../../../../shared/infrastructure/auth/AuthService'
import Router from '../../../../shared/infrastructure/router/Router'
import RouterInterface from '../../../../shared/infrastructure/router/RouterInterface'
import NuxtSocketIO from '../../../../shared/infrastructure/socket/NuxtSocketIO'
import SocketInterface from '../../../../shared/infrastructure/socket/SocketInterface'
import LoginUserCommand from '../application/loginUser/command/LoginUserCommand'
import UserDataInterface from '../domain/UserDataInterface'
import UserRepositoryInterface from '../domain/UserRepositoryInterface'
import UserRepository from '../infrastructure/repository/UserRepository'

@Component
export default class UserLogin extends Vue {
  private auth: AuthInterface
  private router: RouterInterface
  private userRepository: UserRepositoryInterface
  private socket: SocketInterface
  private userData: UserDataInterface = {
    email: '',
    password: '',
  }

  constructor() {
    super()
    this.auth = new AuthService(this.$auth)
    this.router = new Router(this.$router)
    this.socket = new NuxtSocketIO(this.$nuxtSocket({ name: 'chat', channel: '/', reconnection: false }))
    this.userRepository = new UserRepository(this.auth)
  }

  public onSubmit(): void {
    if (!(this.$refs.form as Vue & { validate: () => boolean }).validate()) {
      return
    }

    const loginUserCommand: CommandInterface = new LoginUserCommand(
      this.userRepository,
      this.userData,
      this.socket,
      this.router
    )
    loginUserCommand.execute()
  }
}
</script>
