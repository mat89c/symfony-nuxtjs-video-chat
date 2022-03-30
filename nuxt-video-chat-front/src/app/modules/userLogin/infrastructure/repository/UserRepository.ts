import UserRepositoryInterface from "../../domain/UserRepositoryInterface";
import AuthInterface from "~/src/shared/infrastructure/auth/AuthInterface";
import User from "../../domain/User";

export default class UserRepository implements UserRepositoryInterface {
    private auth: AuthInterface

    constructor(auth: AuthInterface) {
        this.auth = auth
    }

    public async login(user: User): Promise<boolean> {
        return await this.auth.login(user)
    }
} 