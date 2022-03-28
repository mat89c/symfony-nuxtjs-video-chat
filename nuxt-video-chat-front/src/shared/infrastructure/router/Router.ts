import RouterInterface from "./RouterInterface"

export default class Router implements RouterInterface {
    private router: any
    
    constructor(router: any) {
        this.router = router
    }

    push(path: string): void {
        this.router.push(path)
    }
}