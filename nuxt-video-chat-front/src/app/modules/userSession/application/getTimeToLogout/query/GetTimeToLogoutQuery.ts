import QueryInterface from "~/src/shared/application/query/QueryInterface"
import UserSessionRepositoryInterface from "../../../domain/UserSessionRepositoryInterface"

export default class GetTimeToLogoutQuery implements QueryInterface<number> {
    private userSessionRepository: UserSessionRepositoryInterface
    
    constructor(userSessionRepository: UserSessionRepositoryInterface) {
        this.userSessionRepository = userSessionRepository
    }

    query(): number {
        const timeToLogout: number = this.userSessionRepository.getTimeToLogout()
        return parseInt(timeToLogout.toFixed(0))
    }
}