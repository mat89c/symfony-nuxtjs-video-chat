<template>
  <v-snackbar v-model="popupTimerElementVisibility" top right timeout="-1">
    <v-btn @click="onClickPopupTimerElement">
      Za {{ timeToLogout }} s zostaniesz wylogowany. Kliknij, aby przedłużyć
      sesję.
    </v-btn>
  </v-snackbar>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import RunAutoLogoutTimerCommand from '../application/runAutoLogoutTimer/command/RunAutoLogoutTimerCommand'
import RefreshUserSessionCommand from '../application/refreshUserSession/command/RefreshUserSessionCommand'
import CommandInterface from '../../../../shared/application/command/CommandInterface'
import Router from '../../../../shared/infrastructure/router/Router'
import RouterInterface from '../../../../shared/infrastructure/router/RouterInterface'
import UserSessionRepository from '../infrastructure/repository/UserSessionRepository'
import UserSessionRepositoryInterface from '../domain/UserSessionRepositoryInterface'
import GetTimeToLogoutQuery from '../application/getTimeToLogout/query/GetTimeToLogoutQuery'
import GetPopupTimerElementVisibilityQuery from '../application/getPopupTimerElementVisibility/query/GetPopupTimerElementVisibilityQuery'
import QueryInterface from '../../../../shared/application/query/QueryInterface'
import AuthService from '../../../../shared/infrastructure/auth/AuthService'
import AuthInterface from '../../../../shared/infrastructure/auth/AuthInterface'

@Component
export default class UserSession extends Vue {
  private auth: AuthInterface
  private userSessionRepository: UserSessionRepositoryInterface
  private router: RouterInterface

  constructor() {
    super()
    this.auth = new AuthService(this.$auth)
    this.userSessionRepository = new UserSessionRepository(this.$store)
    this.router = new Router(this.$router)
  }

  mounted(): void {
    const runAutoLogoutTimerCommand: CommandInterface =
      new RunAutoLogoutTimerCommand(
        this.auth,
        this.router,
        this.userSessionRepository
      )
    runAutoLogoutTimerCommand.execute()
  }

  get timeToLogout(): number {
    const getTimeToLogoutQuery: QueryInterface<number> =
      new GetTimeToLogoutQuery(this.userSessionRepository)
    return getTimeToLogoutQuery.query()
  }

  get popupTimerElementVisibility(): boolean {
    const getPopupTimerElementVisibilityQuery: QueryInterface<boolean> =
      new GetPopupTimerElementVisibilityQuery(this.userSessionRepository)
    return getPopupTimerElementVisibilityQuery.query()
  }

  public onClickPopupTimerElement(): void {
    const refreshUserSessionCommand: CommandInterface =
      new RefreshUserSessionCommand(this.auth)
    refreshUserSessionCommand.execute()
  }
}
</script>