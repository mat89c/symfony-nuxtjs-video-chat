export default interface SocketInterface {
    emit(event: string, value: any): void
    on(event: string, listener: (...args: any[]) => void): void  
}