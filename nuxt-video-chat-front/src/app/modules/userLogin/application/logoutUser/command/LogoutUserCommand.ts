import CommandInterface from "~/src/shared/application/command/CommandInterface";
import AuthInterface from "~/src/shared/infrastructure/auth/AuthInterface";
import RouterInterface from "~/src/shared/infrastructure/router/RouterInterface";

export default class LogoutUserCommand implements CommandInterface {
    private auth: AuthInterface
    private router: RouterInterface

    constructor(auth: AuthInterface, router: RouterInterface) {
        this.auth = auth
        this.router = router
    }

    public execute(): void {
        this.auth.logout()
        this.router.push('/login')
    }
}