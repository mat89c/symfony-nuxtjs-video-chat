import UserDataInterface from "./UserDataInterface";

export default class User {
    private email: string
    private password: string

    constructor(data: UserDataInterface) {
        this.email = data.email
        this.password = data.password
    }
    
    public getEmail(): string {
        return this.email
    }

    public getPassword(): string {
        return this.password
    }
}