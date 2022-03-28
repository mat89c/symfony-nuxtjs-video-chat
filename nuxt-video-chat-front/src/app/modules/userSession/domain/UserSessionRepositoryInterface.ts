import UserSession from "./UserSession";

export default interface UserSessionRepositoryInterface {
    setPopupTimerElementVisibility(userSession: UserSession): void
    setTimeToLogout(userSession: UserSession): void 
    getPopupTimerElementVisibility(): boolean
    getTimeToLogout(): number
}