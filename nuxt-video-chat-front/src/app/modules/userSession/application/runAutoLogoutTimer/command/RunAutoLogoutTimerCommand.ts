import CommandInterface from "~/src/shared/application/command/CommandInterface"
import UserSessionRepositoryInterface from "../../../domain/UserSessionRepositoryInterface"
import UserSession from "../../../domain/UserSession"
import RouterInterface from "~/src/shared/infrastructure/router/RouterInterface"
import AuthInterface from "~/src/shared/infrastructure/auth/AuthInterface"

export default class RunAutoLogoutTimerCommand implements CommandInterface {
    private auth: AuthInterface
    private router: RouterInterface
    private userSessionRepository: UserSessionRepositoryInterface 
    
    constructor(auth: AuthInterface, router: RouterInterface, userSessionRepository: UserSessionRepositoryInterface) {
        this.auth = auth
        this.router = router
        this.userSessionRepository = userSessionRepository
    }

    public execute(): void {
        const userSession: UserSession = new UserSession()
        
        const logoutTimer: NodeJS.Timeout =  setInterval(() => {
            const tokenExpiration: number = this.auth.getTokenExpiration()
            userSession.calculateAutoLogoutTime(tokenExpiration)
            if (this.auth.isTokenExpired()) {
                this.userSessionRepository.clearInterval(logoutTimer)
                this.auth.logout()
                this.router.push('/login')
            }

            if (userSession.checkToDisplayPopupTimerElement()) {
                userSession.makePopupTimerElementVisible()
                this.userSessionRepository.setTimeToLogout(userSession)
            } else {
                userSession.makePopupTimerElementHidden()
            }

            this.userSessionRepository.setPopupTimerElementVisibility(userSession)

        }, 1000)
    }
}