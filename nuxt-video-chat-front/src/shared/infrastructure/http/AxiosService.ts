import HttpInterface from "./HttpInterface";
import { NuxtAxiosInstance } from "@nuxtjs/axios";

export default class AxiosService implements HttpInterface {
    private axios: NuxtAxiosInstance

    constructor(axios: NuxtAxiosInstance) {
        this.axios = axios
    }

    public post<T>(path: string, data: T): void {
        this.axios.post(path, data)
    }

    public get<T>(path: string, config = {}): Promise<T> {
        return this.axios.get<string, T>(path, config)
    }
}