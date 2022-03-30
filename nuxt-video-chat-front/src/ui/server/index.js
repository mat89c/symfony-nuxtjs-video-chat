var io = require('socket.io')(3000, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST'],
    }
})

var users = []
    
io.on('connection', (socket) => {
    socket.on('user-logged', (username) => {
        users[socket.id] = {
          username,
          socketId: socket.id
        }
       socket.emit('user-logged', users)
    })

    socket.on('send-message', (message) => {
        socket.broadcast.emit('send-message', message)
    })
})  
export default function (req, res, next) {
    next()
}