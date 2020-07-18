import login from './components/auth/login'
import register from './components/auth/register'
// let login = require('./components/auth/login').default

export const routes = [
    {path:'/',component:login,name:'/'},
    {path:'/register',component:register},
]