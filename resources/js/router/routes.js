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

import addProduct from '../components/product/create'
import product from '../components/product/list'
import editProduct from '../components/product/edit'

import addExpense from '../components/expense/create'
import expense from '../components/expense/list'
import editExpense from '../components/expense/edit'

import addCustomer from '../components/customer/create'
import customer from '../components/customer/list'
import editCustomer from '../components/customer/edit'

import salary from '../components/salary/all_employee.vue'
import paySalary from '../components/salary/create.vue'
import allSalary from '../components/salary/list.vue'
import viewSalary from '../components/salary/view.vue'
import editSalary from '../components/salary/edit.vue'


import stock from '../components/stock/list'
import editStock from '../components/stock/edit'

import pos from '../components/pos/pos'

import order from '../components/order/order'
import viewOrder from '../components/order/view'
import searchOrder from '../components/order/search'


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

  // Product Routes
  { path: '/add-product', component: addProduct, name:'add-product'},
  { path: '/product', component: product, name:'product'},
  { path: '/edit-product/:id', component: editProduct, name:'edit-product'},

  // Expense Routes
  { path: '/add-expense', component: addExpense, name:'add-expense'},
  { path: '/expense', component: expense, name:'expense'},
  { path: '/edit-expense/:id', component: editExpense, name:'edit-expense'},

  // Customer Routes
  { path: '/add-customer', component: addCustomer, name:'add-customer'},
  { path: '/customer', component: customer, name:'customer'},
  { path: '/edit-customer/:id', component: editCustomer, name:'edit-customer'},


  // Salary Routes
  { path: '/given-salary', component: salary, name:'given-salary'},
  { path: '/pay-salary/:id', component: paySalary, name:'pay-salary'},
  { path: '/salary', component: allSalary, name:'salary'},
  { path: '/view-salary/:id', component: viewSalary, name:'view-salary'},
  { path: '/edit-salary/:id', component: editSalary, name:'edit-salary'},

 // Stock Routes
  { path: '/stock', component: stock, name:'stock'},
  { path: '/edit-stock/:id', component: editStock, name:'edit-stock'},


 // POS Routes
 { path: '/pos', component: pos, name:'pos'},

 // Order Routes
 { path: '/order', component: order, name:'order'},
 { path: '/view-order/:id', component: viewOrder, name:'view-order'},
 { path: '/searchorder', component: searchOrder, name:'search-order'},



//    TODO : refactor as belows for authentication
// import store from '../store' // your vuex store
//
// const ifNotAuthenticated = (to, from, next) => {
//     if (!store.getters.isAuthenticated) {
//         next()
//         return
//     }
//     next('/')
// }
//
// const ifAuthenticated = (to, from, next) => {
//     if (store.getters.isAuthenticated) {
//         next()
//         return
//     }
//     next('/login')
// }
//
// export default new Router({
//     mode: 'history',
//     routes: [
//         {
//             path: '/',
//             name: 'Home',
//             component: Home,
//         },
//         {
//             path: '/account',
//             name: 'Account',
//             component: Account,
//             beforeEnter: ifAuthenticated,
//         },
//         {
//             path: '/login',
//             name: 'Login',
//             component: Login,
//             beforeEnter: ifNotAuthenticated,
//         },
//     ],
// })
]
