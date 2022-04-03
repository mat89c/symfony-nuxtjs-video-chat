export default class UserSession {
    private timeToLogout: number = 0
    private popupTimerElementVisibility: boolean = false

    public static readonly POPUP_DISPLAY_TIMES = {
        FROM: 31,
        TO: 1
    }   

    public calculateAutoLogoutTime(tokenExpiration: number): void {
        const timestampNow: number = +new Date()
        const diff: number = tokenExpiration - timestampNow
        const time: number = diff / 1000
       
        this.timeToLogout = time
    }

    public getTimeToLogout(): number {
        return this.timeToLogout
    }

    public getPopupTimerElementVisibility(): boolean {
        return this.popupTimerElementVisibility
    }

    public checkToDisplayPopupTimerElement(): boolean {
        if (this.timeToLogout < UserSession.POPUP_DISPLAY_TIMES.FROM && this.timeToLogout > UserSession.POPUP_DISPLAY_TIMES.TO) {
            return true
        }

        return false
    }

    public makePopupTimerElementVisible(): void {
        this.popupTimerElementVisibility = true
    }

    public makePopupTimerElementHidden(): void {
        this.popupTimerElementVisibility = false
    }
}