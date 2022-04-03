export default interface HttpInterface {
    get<T>(path: string, config?: object): Promise<T>
    post<T>(path: string, data: T): void
}