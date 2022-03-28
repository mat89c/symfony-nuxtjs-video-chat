import User from "~/src/app/modules/userLogin/domain/User";

export default interface AuthInterface {
    refreshSession(): void
    isTokenExpired(): boolean
    getTokenExpiration(): number
    login(user: User): Promise<boolean>
    logout(): void
}