import axios from "axios";
import router from '../router/roter'


axios.defaults.baseURL ='/api';


axios.interceptors.request.use((config) => {
    const token = window.localStorage.getItem('token');
    if (token) config.headers.Authorization = `Bearer ${token}`;
    return config;
}, error => {
    return Promise.reject(error);
})


axios.interceptors.response.use(undefined, error => {

    if (error.message === 'Network Error' && !error.response) {
        toast.error('Network error - make sure API is running!')
    }
    const {status, data, config,headers} = error.response;

    if (status === 404) {
        router.push('/notfound')
    }
    if (status === 401) {
        Toast.fire({
            icon:'warning',
            title:'Password or mail is invalid'
        })
    }
    if (status === 401 && headers['www-authenticate'] === 'Bearer error="invalid_token", error_description="The token is expired"') {
        window.localStorage.removeItem('jwt');
        router.push('/')
        Toast.fire({
            icon:'warning',
            title:'Your session has expired, please login again'
        })
      }
    // if (status === 400 && config.method === 'get' && data.errors.hasOwnProperty('id')) {
    //     router.push('/notfound')

    // }
    if (status === 500) {
        // console.log(error.data.)
        Toast.fire({
            icon:'warning',
            title:'Server error - check the terminal for more info!'
        })
    }
    throw error.response;
})

const responseBody = (response)=>response.data;


const requests = {
    get: (url)=> axios.get(url).then(responseBody),
    getWithParams: (url,body)=> axios.get(url, {params:body}).then(responseBody),
    post: (url,body)=> axios.post(url,body).then(responseBody),
    put: (url,body)=> axios.put(url,body).then(responseBody),
    del: (url)=> axios.delete(url).then(responseBody),
}

const Employee = {
    list: () => requests.get(`/employees`),
    details: (id) => requests.get(`/employees/${id}`),
    create: (employee) => requests.post('/employees', employee),
    update: (employee) =>requests.put(`/employees/${employee.id}`, employee),
    delete: (id) => requests.del(`/employees/${id}`),
  };

  const Supplier = {
    list: () => requests.get(`/suppliers`),
    details: (id) => requests.get(`/suppliers/${id}`),
    create: (supplier) => requests.post('/suppliers', supplier),
    update: (supplier) =>requests.put(`/suppliers/${supplier.id}`, supplier),
    delete: (id) => requests.del(`/suppliers/${id}`),
  };

  const Category = {
    list: () => requests.get(`/categories`),
    details: (id) => requests.get(`/categories/${id}`),
    create: (category) => requests.post('/categories', category),
    update: (category) =>requests.put(`/categories/${category.id}`, category),
    delete: (id) => requests.del(`/categories/${id}`),
  };

  const Product = {
    list: () => requests.get(`/products`),
    details: (id) => requests.get(`/products/${id}`),
    create: (product) => requests.post('/products', product),
    update: (product) =>requests.put(`/products/${product.id}`, product),
    delete: (id) => requests.del(`/products/${id}`),
  };

  const Expense = {
    list: () => requests.get(`/expenses`),
    details: (id) => requests.get(`/expenses/${id}`),
    create: (expense) => requests.post('/expenses', expense),
    update: (expense) =>requests.put(`/expenses/${expense.id}`, expense),
    delete: (id) => requests.del(`/expenses/${id}`),
  };

  const Customer = {
    list: () => requests.get(`/customers`),
    details: (id) => requests.get(`/customers/${id}`),
    create: (customer) => requests.post('/customers', customer),
    update: (customer) =>requests.put(`/customers/${customer.id}`, customer),
    delete: (id) => requests.del(`/customers/${id}`),
  };

  const Salary = {
    list: () => requests.get(`/salary`),
    pay: (data) => requests.post(`/salary/pay`,data),
    update: (data) => requests.post(`/salary/update/${data.id}`,data),
    edit: (id) => requests.get(`/edit/salary/${id}`),
    view: (id) => requests.get(`/salary/view/${id}`),
  };

  const Stock = {
      update: (data) => requests.post(`/stock/update/${data.id}`,data),
  };

    const Reports = {

        dateReports: (data) => requests.getWithParams(`/reports/date/reports`,data),



        // sell: () => requests.get(`/reports/today/sell`),
        // income: () => requests.get(`/reports/today/income`),
        // due: () => requests.get(`/reports/today/due`),
        // expense: () => requests.get(`/reports/today/expense`),
        stockOut: () => requests.get(`/reports/today/stock-out`),
    };

    const Regulations = {
        get: () => requests.get(`/regulations`),
    }

const Order = {
    list: (data) => requests.getWithParams(`/orders`,data),
    order: (id) => requests.get(`/order/${id}`),
    search:(data)=>requests.post('/search/order',data),
    submitOrder: (order) => requests.post(`/order/`,order),

};

const Cart = {
    add: (id) => requests.get(`/cart/add/${id}`),
    remove: (id) => requests.get(`/cart/remove/${id}`),
    products: () => requests.get(`/cart/products`),
    increment: (id) => requests.get(`/cart/product/increment/${id}`),
    decrement: (id) => requests.get(`/cart/product/decrement/${id}`),
};

const User = {
    // current: (): Promise<IUser> => requests.get('/user'),
    login: (user) => requests.post(`/auth/login`, user),
    register: (user) => requests.post(`/auth/signup`, user),
}


export default {
    // Activities,
    User,
    Employee,
    Supplier,
    Category,
    Product,
    Expense,
    Customer,
    Salary,
    Stock,
    Reports,
    Regulations,
    Order,
    Cart
    // Profiles
}
