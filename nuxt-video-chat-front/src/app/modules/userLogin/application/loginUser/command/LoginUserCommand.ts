import CommandInterface from "~/src/shared/application/command/CommandInterface";
import UserDataInterface from "../../../domain/UserDataInterface";
import UserRepositoryInterface from "../../../domain/UserRepositoryInterface";
import User from "../../../domain/User";

export default class LoginUserCommand implements CommandInterface {
    private userRepository: UserRepositoryInterface
    private userData: UserDataInterface

    constructor(userRepository: UserRepositoryInterface, userData: UserDataInterface) {
        this.userRepository = userRepository
        this.userData = userData
    }

    public execute(): void  {
        const user = new User(this.userData)
        this.userRepository.login(user)
    }
}