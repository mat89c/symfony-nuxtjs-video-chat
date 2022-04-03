import UserSessionRepositoryInterface from "../../domain/UserSessionRepositoryInterface";
import { Store } from 'vuex'
import UserSession from "../../domain/UserSession";

export default class UserSessionRepository implements UserSessionRepositoryInterface {
    private store: Store<any>
    
    constructor(store: Store<any>) {
        this.store = store
    }

    public setPopupTimerElementVisibility(userSession: UserSession): void {
        this.store.dispatch('userSessionStore/setPopupTimerElementVisibility', userSession)
    }

    public setTimeToLogout(userSession: UserSession): void {
        this.store.dispatch('userSessionStore/setTimeToLogout', userSession)
    } 

    public getPopupTimerElementVisibility(): boolean {
        return this.store.getters['userSessionStore/getPopupTimerElementVisibility']
    }

    public getTimeToLogout(): number {
        return this.store.getters['userSessionStore/getTimeToLogout']
    } 

    public clearInterval(interval: NodeJS.Timeout): void {
        clearInterval(interval)
    }
}