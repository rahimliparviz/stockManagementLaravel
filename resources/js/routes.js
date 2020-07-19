import login from './components/auth/login'
import register from './components/auth/register'
import forget from './components/auth/forget'
import home from './components/home'
// let login = require('./components/auth/login').default

export const routes = [
    {path:'/',component:login,name:'/'},
    {path:'/register',component:register},
    {path:'/forget',component:forget},
    {path:'/home',component:home,name:'home'},
]