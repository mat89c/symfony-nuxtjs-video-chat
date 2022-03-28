import QueryInterface from "~/src/shared/application/query/QueryInterface";
import UserSessionRepositoryInterface from "../../../domain/UserSessionRepositoryInterface";

export default class GetPopupTimerElementVisibility implements QueryInterface<boolean> {
    private userSessionRepository: UserSessionRepositoryInterface

    constructor(userSessionRepository: UserSessionRepositoryInterface) {
        this.userSessionRepository = userSessionRepository
    }

    public query(): boolean {
        return this.userSessionRepository.getPopupTimerElementVisibility()
    }
}