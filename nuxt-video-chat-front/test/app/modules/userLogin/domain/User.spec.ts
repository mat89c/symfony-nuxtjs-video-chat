import User from "~/src/app/modules/userLogin/domain/User"
import { mockUserData } from "./User.mock"

describe('User', () => {
    describe('constructor', () => {
        it('should create instance with data', () => {
            const user = new User(mockUserData)
            expect(user).toBeInstanceOf(User)
        }) 
    })
    
    describe('getEmail',  () => {
        it('should return email as string', () => { 
            const user = new User(mockUserData)
            expect(user.getEmail()).toBe('user@example.com')
        })
    })

    describe('getUsername', () => {
        it('should return username as string', () => {
            const user = new User(mockUserData)
            expect(user.getPassword()).toBe('pass1234')
        })
    })
})