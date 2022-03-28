import { GetterTree, Module, MutationTree, ActionTree } from 'vuex'
import RootStateInterface from '~/src/ui/store/RootStateInterface'
import UserSession from '../../domain/UserSession'
import UserSessionStateInterface from './UserSessionStateInterface'

class UserSessionStore implements Module<UserSessionStateInterface, RootStateInterface> {
    public namespaced: boolean = true

    public state: UserSessionStateInterface = {
        timeToLogout: 0,
        popupTimerElementVisibility: false
    }

    public getters: GetterTree<UserSessionStateInterface, RootStateInterface> = {
        getTimeToLogout(state: UserSessionStateInterface): number {
            return state.timeToLogout
        },
        
        getPopupTimerElementVisibility(state: UserSessionStateInterface): boolean {
            return state.popupTimerElementVisibility
        }
    }

    public actions: ActionTree<UserSessionStateInterface, RootStateInterface> = {
        showPopupTimerElement({ commit }, userSession: UserSession): void {
            commit('SHOW_POPUP_TIMER_ELEMENT', userSession)
        },

        setPopupTimerElementVisibility({ commit }, userSession: UserSession): void {
            commit('SET_POPUP_TIMER_VISIBILITY', userSession)
        }
    }

    public mutations: MutationTree<UserSessionStateInterface> = {
        SET_TIME_TO_LOGOUT (state: UserSessionStateInterface, userSession: UserSession): void {
            state.timeToLogout = userSession.getTimeToLogout()
        },
        
        SET_POPUP_TIMER_VISIBILITY(state: UserSessionStateInterface, userSession: UserSession): void {
            state.popupTimerElementVisibility = userSession.getPopupTimerElementVisibility()
        }
    }
}

export default UserSessionStore
