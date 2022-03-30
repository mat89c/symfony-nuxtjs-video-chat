import type { NuxtSocket } from 'nuxt-socket-io';
import SocketInterface from './SocketInterface';

export default class NuxtSocketIO implements SocketInterface {
    private socket: NuxtSocket
    
    constructor(socket: NuxtSocket) {
        this.socket = socket
    }

    public emit(event: string, value: any): void {
        this.socket.emit(event, value)
    }

    public on(event: string, listener: (...args: any[]) => void): void {
        this.socket.on(event, listener)
    } 
}