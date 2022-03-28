import AuthInterface from "./AuthInterface";
import { Auth, RefreshableScheme } from '@nuxtjs/auth-next'
import User from "~/src/app/modules/userLogin/domain/User";

export default class AuthService implements AuthInterface {
    private auth: Auth

    constructor(auth: Auth) {
        this.auth = auth
    }

    refreshSession(): void {
        this.auth.refreshTokens()
    }

    isTokenExpired(): boolean {
        const isTokenExpired: boolean = (this.auth.strategy as RefreshableScheme).refreshToken.status().expired()
        return isTokenExpired
    }

    getTokenExpiration(): number {
        const tokenExpiration: number = this.auth.$storage.getState('_refresh_token_expiration.local') as number
        return tokenExpiration
    }

    async login(user: User): Promise<boolean> {
        return await this.auth.loginWith('local', {
            data: {
                email: user.getEmail(),
                password: user.getPassword()
            }
        }).then(() => true)
    }

    logout(): void {
        this.auth.logout()
    }
}