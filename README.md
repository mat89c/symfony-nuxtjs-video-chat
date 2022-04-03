Symfony + Nuxt.js + TypeScript + NuxtSocketIO Video Chat App
==============
Application based on Symfony, Nuxt.js + Typescript  and Socket IO.      

**Development in progres**

### About
This is an example of implementation a hexagonal architecture in fronted and backend.
### To do
- [x] Docker environment
- [x] Hexagonal architecture
- [x] CQRS based on Symfony Messenger
- [x] Global chat
- [ ] Add RabbitMQ for async commands  
- [ ] Add calendar context 
- [ ] Video calls based on WebRTC

### The directory structure (Symfony app)
    src
       \
        |- Core
        |      \
        |       |- Bounded context
        |       |                 \
        |       |                  |- Application
        |       |                  |- Domain
        |       |                  |- Infrastructure
        |       |                  |- UI
        |                               
        |- Shared
        |      \
        |       |- Application
        |       |- Infrastructure


### The directory structure (Nuxt.js app)
    src
       \
        |- app
        |     \
        |     |- modules
        |               \
        |               |- module
        |               |        \
        |               |         |- application
        |               |         |- domain
        |               |         |- infrastructure
        |               |         |- ui
        |                               
        |- shared
        |      \
        |       |- application
        |       |- infrastructure