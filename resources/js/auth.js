import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'
/**
 * Authentication configuration, some of the options can be override in method calls
 */
const config = {
  auth: bearer,
  http: axios,
  router: router,
  tokenDefaultName: 'laravel-jwt-auth',
  tokenStore: ['localStorage'],
  
  // API endpoints used in Vue Auth.
  registerData: {
    url: '/register', 
    method: 'POST', 
    redirect: '/login'
  },
  loginData: {
    url: '/login', 
    method: 'POST', 
    redirect: '', 
    fetchUser: true
  },
  logoutData: {
    url: '/logout', 
    method: 'POST', 
    redirect: '/', 
    makeRequest: true
  },
  fetchData: {
    url: '/user', 
    method: 'GET', 
    enabled: true
  },
  refreshData: {
    url: '/refresh', 
    method: 'GET', 
    enabled: true, 
    interval: 30
  }
}
export default config