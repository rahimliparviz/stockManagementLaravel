import login from '../components/auth/login'
import register from '../components/auth/register'
import forget from '../components/auth/forget'
import home from '../components/home'
import logout from '../components/auth/logout'

import addEmployee from '../components/employee/create'
import employees from '../components/employee/list'
import editEmployee from '../components/employee/edit'

import addSupplier from '../components/supplier/create'
import suppliers from '../components/supplier/list'
import editSupplier from '../components/supplier/edit'

import addCategory from '../components/category/create'
import category from '../components/category/list'
import editCategory from '../components/category/edit'


// let login = require('./components/auth/login').default

export const routes = [
    {path:'/',component:login,name:'/'},
    {path:'/register',component:register},
    {path:'/logout',component:logout},
    {path:'/forget',component:forget},
    {path:'/home',component:home,name:'home'},

    // Employee Routes
    {path:'/add-employee',component:addEmployee,name:'add-employee'},
    {path:'/employees',component:employees,name:'employees'},
    { path: '/edit-employee/:id', component: editEmployee, name:'edit-employee'},

      // Supplier Routes
  { path: '/add-supplier', component: addSupplier, name:'add-supplier'},
  { path: '/suppliers', component: suppliers, name:'suppliers'},
  { path: '/edit-supplier/:id', component: editSupplier, name:'edit-supplier'},

//  // Category Routes
  { path: '/add-category', component: addCategory, name:'add-category'},
  { path: '/category', component: category, name:'category'},
  { path: '/edit-category/:id', component: editCategory, name:'edit-category'},

//   // Product Routes
//   { path: '/add-product', component: addProduct, name:'add-product'},
//   { path: '/product', component: product, name:'product'},
//   { path: '/edit-product/:id', component: editproduct, name:'edit-product'},
]