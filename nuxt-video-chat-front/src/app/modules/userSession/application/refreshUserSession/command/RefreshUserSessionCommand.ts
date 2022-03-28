import CommandInterface from "~/src/shared/application/command/CommandInterface";
import AuthInterface from "~/src/shared/infrastructure/auth/AuthInterface";

export default class RefreshUserSessionCommand implements CommandInterface {
    private auth: AuthInterface

    constructor(auth: AuthInterface) {
        this.auth = auth
    }

    public execute(): void {
        this.auth.refreshSession()
    }
}