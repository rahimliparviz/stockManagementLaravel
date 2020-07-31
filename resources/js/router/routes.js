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


// export const routes = [
//     {path:'/',component:login,name:'/'},
//     {path:'/register',component:register},
//     {path:'/logout',component:logout},
//     {path:'/forget',component:forget},
//     {path:'/home',component:home,name:'home'},
//
//     // Employee Routes
//     {path:'/add-employee',component:addEmployee,name:'add-employee'},
//     {path:'/employees',component:employees,name:'employees'},
//     { path: '/edit-employee/:id', component: editEmployee, name:'edit-employee'},
//
//       // Supplier Routes
//   { path: '/add-supplier', component: addSupplier, name:'add-supplier'},
//   { path: '/suppliers', component: suppliers, name:'suppliers'},
//   { path: '/edit-supplier/:id', component: editSupplier, name:'edit-supplier'},
//
// //  // Category Routes
//   { path: '/add-category', component: addCategory, name:'add-category'},
//   { path: '/categories', component: category, name:'categories'},
//   { path: '/edit-category/:id', component: editCategory, name:'edit-category'},
//
//   // Product Routes
//   { path: '/add-product', component: addProduct, name:'add-product'},
//   { path: '/products', component: product, name:'products'},
//   { path: '/edit-product/:id', component: editProduct, name:'edit-product'},
//
//   // Expense Routes
//   { path: '/add-expense', component: addExpense, name:'add-expense'},
//   { path: '/expenses', component: expense, name:'expenses'},
//   { path: '/edit-expense/:id', component: editExpense, name:'edit-expense'},
//
//   // Customer Routes
//   { path: '/add-customer', component: addCustomer, name:'add-customer'},
//   { path: '/customers', component: customer, name:'customers'},
//   { path: '/edit-customer/:id', component: editCustomer, name:'edit-customer'},
//
//
//   // Salary Routes
//   { path: '/given-salary', component: salary, name:'given-salary'},
//   { path: '/pay-salary/:id', component: paySalary, name:'pay-salary'},
//   { path: '/salaries', component: allSalary, name:'salaries'},
//   { path: '/view-salary/:id', component: viewSalary, name:'view-salary'},
//   { path: '/edit-salary/:id', component: editSalary, name:'edit-salary'},
//
//  // Stock Routes
//   { path: '/stock', component: stock, name:'stock'},
//   { path: '/edit-stock/:id', component: editStock, name:'edit-stock'},
//
//
//  // POS Routes
//  { path: '/pos', component: pos, name:'pos'},
//
//  // Order Routes
//  { path: '/orders', component: order, name:'orders'},
//  { path: '/view-order/:id', component: viewOrder, name:'view-order'},
//  { path: '/searchorder', component: searchOrder, name:'search-order'},
//
// ]




//    TODO : refactor as belows for authentication
import {store} from '../store/store';

const ifNotAuthenticated = (to, from, next) => {
    if (!store.getters.isAuthenticated) {
        next()
        return
    }
    next('/')
}

const ifAuthenticated = (to, from, next) => {
    if (store.getters.isAuthenticated) {
        next()
        return
    }
    next('/login')
}


// export const routes =
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
//         }
//     ]


export const routes = [
    {path:'/login',component:login,name:'login',beforeEnter:ifNotAuthenticated},
    {path:'/register',component:register,beforeEnter:ifNotAuthenticated},
    {path:'/logout',component:logout},
    {path:'/forget',component:forget,beforeEnter:ifNotAuthenticated},
    {path:'/',component:home,name:'home',beforeEnter:ifAuthenticated},

    // Employee Routes
    {path:'/add-employee',component:addEmployee,name:'add-employee',beforeEnter:ifAuthenticated},
    {path:'/employees',component:employees,name:'employees',beforeEnter:ifAuthenticated},
    { path: '/edit-employee/:id', component: editEmployee, name:'edit-employee',beforeEnter:ifAuthenticated},

    // Supplier Routes
    { path: '/add-supplier', component: addSupplier, name:'add-supplier',beforeEnter:ifAuthenticated},
    { path: '/suppliers', component: suppliers, name:'suppliers',beforeEnter:ifAuthenticated},
    { path: '/edit-supplier/:id', component: editSupplier, name:'edit-supplier',beforeEnter:ifAuthenticated},

//  // Category Routes
    { path: '/add-category', component: addCategory, name:'add-category',beforeEnter:ifAuthenticated},
    { path: '/categories', component: category, name:'categories',beforeEnter:ifAuthenticated},
    { path: '/edit-category/:id', component: editCategory, name:'edit-category',beforeEnter:ifAuthenticated},

    // Product Routes
    { path: '/add-product', component: addProduct, name:'add-product',beforeEnter:ifAuthenticated},
    { path: '/products', component: product, name:'products',beforeEnter:ifAuthenticated},
    { path: '/edit-product/:id', component: editProduct, name:'edit-product',beforeEnter:ifAuthenticated},

    // Expense Routes
    { path: '/add-expense', component: addExpense, name:'add-expense',beforeEnter:ifAuthenticated},
    { path: '/expenses', component: expense, name:'expenses',beforeEnter:ifAuthenticated},
    { path: '/edit-expense/:id', component: editExpense, name:'edit-expense',beforeEnter:ifAuthenticated},

    // Customer Routes
    { path: '/add-customer', component: addCustomer, name:'add-customer',beforeEnter:ifAuthenticated},
    { path: '/customers', component: customer, name:'customers',beforeEnter:ifAuthenticated},
    { path: '/edit-customer/:id', component: editCustomer, name:'edit-customer',beforeEnter:ifAuthenticated},


    // Salary Routes
    { path: '/given-salary', component: salary, name:'given-salary',beforeEnter:ifAuthenticated},
    { path: '/pay-salary/:id', component: paySalary, name:'pay-salary',beforeEnter:ifAuthenticated},
    { path: '/salaries', component: allSalary, name:'salaries',beforeEnter:ifAuthenticated},
    { path: '/view-salary/:id', component: viewSalary, name:'view-salary',beforeEnter:ifAuthenticated},
    { path: '/edit-salary/:id', component: editSalary, name:'edit-salary',beforeEnter:ifAuthenticated},

    // Stock Routes
    { path: '/stock', component: stock, name:'stock',beforeEnter:ifAuthenticated},
    { path: '/edit-stock/:id', component: editStock, name:'edit-stock',beforeEnter:ifAuthenticated},


    // POS Routes
    { path: '/pos', component: pos, name:'pos',beforeEnter:ifAuthenticated},

    // Order Routes
    { path: '/orders', component: order, name:'orders',beforeEnter:ifAuthenticated},
    { path: '/view-order/:id', component: viewOrder, name:'view-order',beforeEnter:ifAuthenticated},
    { path: '/searchorder', component: searchOrder, name:'search-order',beforeEnter:ifAuthenticated},

    //Not found
    { path: '*',  redirect: { name: 'login' } }

]
