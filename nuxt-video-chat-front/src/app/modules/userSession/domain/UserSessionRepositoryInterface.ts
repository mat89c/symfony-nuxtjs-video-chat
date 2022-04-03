import UserSession from "./UserSession";

export default interface UserSessionRepositoryInterface {
    setPopupTimerElementVisibility(userSession: UserSession): void
    setTimeToLogout(userSession: UserSession): void 
    clearInterval(interval: NodeJS.Timeout): void
    getPopupTimerElementVisibility(): boolean
    getTimeToLogout(): number
}