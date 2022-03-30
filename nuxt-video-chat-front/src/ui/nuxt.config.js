import path from 'path' 
import pl from 'vuetify/src/locale/pl.ts'


export default {
  rootDir: '.',

  srcDir: 'src/ui',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    titleTemplate: '%s - Video Chat App',
    title: 'Video Chat App',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' },
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/axios.ts',
    '~/plugins/validation.ts'
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: false,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/typescript
    '@nuxt/typescript-build',
    // https://go.nuxtjs.dev/vuetify
    '@nuxtjs/vuetify',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    // https://go.nuxtjs.dev/pwa
    '@nuxtjs/pwa',
    '@nuxtjs/auth-next',
    'nuxt-socket-io',
  ],

  io: {
    sockets: [
      {
        name: 'chat',
        url: 'http://video-chat.pl',
        default: true,
      }
    ]
  },  

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    baseURL: 'http://api.video-chat.pl',  
  },

  auth: {
    localStorage: false,
    strategies: {
      local: {
        scheme: 'refresh',
        endpoints: {
          login: { url: '/api/login_check', method: 'post' },
          refresh: { url: '/api/token/refresh', method: 'post' },
          user: { url: '/api/user/get-logged-user', method:'get' },
          logout: false
        },
        token: {
          property: 'token',
          maxAge: 600
        },
        refreshToken: {
          property: 'refresh_token',
          data: 'refresh_token',
          maxAge: 1200
        },
        user: {
          property: 'user'
        }
      }
    },
    plugins: [
      { src: '@/plugins/axios', ssr: true }
    ],
    scopeKey: 'roles'
  },

  // PWA module configuration: https://go.nuxtjs.dev/pwa
  pwa: {
    manifest: {
      lang: 'pl',
    },
  },

  // Vuetify module configuration: https://go.nuxtjs.dev/config-vuetify
  vuetify: {
    lang: {
      locales: { pl },
      current: 'pl'
    }, 
    customVariables: ['~/assets/variables.scss'],
    theme: {
      dark: true,
      themes: {
        dark: { 
        },
      },
    },
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    extend(config) {
      // eslint-disable-next-line @typescript-eslint/ban-ts-comment
      // @ts-ignore "Property 'buildContext' does not exist on type 'NuxtOptionsBuild'"
      const rootDir = this.buildContext.options.rootDir
      const joinSrc = (s) => path.join(rootDir, 'src', s)

      if (!config?.resolve?.alias) {
        throw new Error('webpack config aliases not found!')
      }

      config.resolve.alias['@modules'] = joinSrc('modules')
      config.resolve.alias['@shared'] = joinSrc('shared')
      config.resolve.alias['@ui'] = joinSrc('ui')
    },
  },

  serverMiddleware: ['~/server/index.js'],

  server: {
    host: '0.0.0.0',
    port: 5000
  }
}
