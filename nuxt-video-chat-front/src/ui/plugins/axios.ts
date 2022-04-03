import type { Plugin } from '@nuxt/types'
import { TokenableScheme } from '@nuxtjs/auth-next'
import NotificationRepository from '../../app/modules/notification/infrastructure/repository/NotificationRepository'
import SetNotificationCommand from '../../app/modules/notification/application/setNotification/command/SetNotificationCommand'
import CommandInterface from '../../shared/application/command/CommandInterface'

const axiosPlugin: Plugin = ({
    $axios,
    $auth,
    store
}): void => {
    const notificationRepository = new NotificationRepository(store)

    if (typeof $auth !== 'undefined') {
        $axios.interceptors.request.use((config) => {
            config.headers.Authorization = `${($auth.strategy as TokenableScheme).token.get()}`
            return config
        })
    
        $axios.interceptors.response.use(
            res => res,
            async (error) => {   
                if (typeof error.response !== 'undefined' && error.response.status === 404) {
                    const showNotificationCommand: CommandInterface =
                        new SetNotificationCommand(
                        {
                            message: error.response.data.message,
                            visibility: true,
                            bgColor: 'red'
                        },
                        notificationRepository
                    )

                    showNotificationCommand.execute()
                }

                if (typeof error.response !== 'undefined' && error.response.status === 401) {
                    const showNotificationCommand: CommandInterface =
                        new SetNotificationCommand(
                        {
                            message: 'Nieprawidłowe dane logowania',
                            visibility: true,
                            bgColor: 'red'
                        },
                        notificationRepository
                    )

                    showNotificationCommand.execute()
                }

                if (typeof error.response !== 'undefined' && error.response.data.message !== 'undefined' && error.response.status === 400) {
                    const showNotificationCommand: CommandInterface =
                        new SetNotificationCommand(
                        {
                            message: error.response.data.message,
                            visibility: true,
                            bgColor: 'red'
                        },
                        notificationRepository
                    )

                    showNotificationCommand.execute()
                }
    
                return await Promise.reject(error)
            }
        )
    }
}

export default axiosPlugin