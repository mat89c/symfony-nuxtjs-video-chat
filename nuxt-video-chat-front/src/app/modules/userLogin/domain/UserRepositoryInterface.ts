import User from "./User";

export default interface UserRepositoryInterface {
    login(user: User): Promise<boolean>
}