
import colors from 'vuetify/es5/util/colors'

export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  
  head: {
    title: 'Danza Con la Muerte',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      {
        rel: 'icon',
        type:'image/x-icon',
        href: '/favicon.ico'
      }
    ],
    link: [
      {
        rel: 'stylesheet',
        href: '/css/bootstrap.min.css'
      }
    ],
    link: [
      { 
        rel: 'stylesheet',
        href: '/css/custom.css'
      }
    ],
    script: [
      {
        src :'/js/bootstrap.min.js',
        type: 'text/javascript'
      }
    ]
  },


  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '@/static/css/bootstrap.css'
  ],
  js: [
    '@/static/js/bootstrap.min.js'
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
   
    

  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
    '@nuxtjs/tailwindcss',
   // Simple usage
   '@nuxtjs/vuetify',

 // With options
   ['@nuxtjs/vuetify', { /* module options */ }]


  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    'vue-sweetalert2/nuxt',

  
  ],
  sweetalert: {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674'
  },
  auth: {
    strategies: {
        'laravelSanctum': {
            provider: 'laravel/sanctum',
            url: 'http://localhost:8000',
            endpoints: {
                login: {
                    url: '/login'
                },
                logout: {
                    url: '/logout'
                },
                user: {
                    url: '/api/user'
                }
                
            },
            user: {
                property: false
            }
        },
      
    },
    redirect: {
      login: '/auth/login',
      logout: '/',
      home: '/',
  }

  },

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    baseURL: 'http://localhost:8000/',
    credentials: true
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },
  
}
