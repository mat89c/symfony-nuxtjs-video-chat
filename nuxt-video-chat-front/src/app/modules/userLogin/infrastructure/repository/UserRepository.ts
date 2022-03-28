import UserRepositoryInterface from "../../domain/UserRepositoryInterface";
import AuthInterface from "~/src/shared/infrastructure/auth/AuthInterface";
import User from "../../domain/User";
import RouterInterface from "~/src/shared/infrastructure/router/RouterInterface";

export default class UserRepository implements UserRepositoryInterface {
    private auth: AuthInterface
    private router: RouterInterface

    constructor(auth: AuthInterface, router: RouterInterface) {
        this.auth = auth
        this.router = router
    }

    public login(user: User): void {
        this.auth.login(user).then(() => this.router.push('/'))
    }
} 