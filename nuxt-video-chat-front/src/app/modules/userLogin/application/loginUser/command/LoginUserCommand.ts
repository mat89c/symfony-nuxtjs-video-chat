import CommandInterface from "~/src/shared/application/command/CommandInterface";
import UserDataInterface from "../../../domain/UserDataInterface";
import UserRepositoryInterface from "../../../domain/UserRepositoryInterface";
import User from "../../../domain/User";
import SocketInterface from "~/src/shared/infrastructure/socket/SocketInterface";
import RouterInterface from "~/src/shared/infrastructure/router/RouterInterface";

export default class LoginUserCommand implements CommandInterface {
    private userRepository: UserRepositoryInterface
    private userData: UserDataInterface
    private socket: SocketInterface
    private router: RouterInterface

    constructor(userRepository: UserRepositoryInterface, userData: UserDataInterface, socket: SocketInterface, router: RouterInterface) {
        this.userRepository = userRepository
        this.userData = userData
        this.socket = socket
        this.router = router
    }

    public execute(): void  {
        const user = new User(this.userData)
        this.userRepository.login(user).then(() => {
            this.router.push('/')
        })
    }
}