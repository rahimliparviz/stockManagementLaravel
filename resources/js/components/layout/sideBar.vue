<template>
    <nav>

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/home">
                <div class="sidebar-brand-icon">
                    <img :src="baseUrl+'/backend/img/logo/logo2.png'" rel="icon">
                </div>
                <div class="sidebar-brand-text mx-3">Inventory System</div>
            </router-link>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <router-link class="nav-link" to="/home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></router-link>
            </li>

            <li class="nav-item active">
                <router-link class="nav-link" to="/pos">
                    <i class="fas fa-cart-plus"></i>
                    <span>Pos</span></router-link>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Features
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee"
                   aria-expanded="true" aria-controls="collapseEmployee">
                    <i class="fa fa-users"></i>
                    <span>Employees</span>
                </a>
                <div id="collapseEmployee" class="collapse" aria-labelledby="headingEmployee"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link class="collapse-item" to="/add-employee">Add Employee</router-link>
                        <router-link class="collapse-item" to="/employees">All Employees</router-link>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupplier"
                   aria-expanded="true" aria-controls="collapseSupplier">
                    <i class="fas fa-truck"></i>
                    <span>Suppliers</span>
                </a>
                <div id="collapseSupplier" class="collapse" aria-labelledby="headingSupplier"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <router-link class="collapse-item" to="/add-supplier">Add Supplier</router-link>
                        <router-link class="collapse-item" to="/suppliers">All Suppliers</router-link>

                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSalary"
                   aria-expanded="true" aria-controls="collapseSalary">
                    <i class="fas fa-money-check"></i>
                    <span>Salary</span>
                </a>
                <div id="collapseSalary" class="collapse" aria-labelledby="headingBootstrap"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <router-link class="collapse-item" to="/given-salary">Add Salary</router-link>
                        <router-link class="collapse-item" to="/salaries">All Salary</router-link>

                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder"
                   aria-expanded="true" aria-controls="collapseOrder">
                    <i class="fas fa-list"></i>
                    <span>Orders</span>
                </a>
                <div id="collapseOrder" class="collapse" aria-labelledby="headingBootstrap"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <router-link class="collapse-item" to="/orders">Today Orders</router-link>
                        <router-link class="collapse-item" to="/searchorder">Search</router-link>

                    </div>
                </div>
            </li>


            <li class="nav-item">
                <router-link class="nav-link" to="/stock">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Stock</span>
                </router-link>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
                   aria-expanded="true" aria-controls="collapseCategory">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Category</span>
                </a>
                <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <router-link class="collapse-item" to="/add-category">Add Category</router-link>
                        <router-link class="collapse-item" to="/categories">All Categories</router-link>

                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
                   aria-expanded="true" aria-controls="collapseProducts">
                    <i class="fab fa-product-hunt"></i>
                    <span>Products</span>
                </a>
                <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <router-link class="collapse-item" to="/add-product">Add Product</router-link>
                        <router-link class="collapse-item" to="/products">All Products</router-link>

                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpence"
                   aria-expanded="true" aria-controls="collapseExpence">
                    <i class="fas fa-funnel-dollar"></i>
                    <span>Expense</span>
                </a>
                <div id="collapseExpence" class="collapse" aria-labelledby="headingBootstrap"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <router-link class="collapse-item" to="/add-expense">Add Expense</router-link>
                        <router-link class="collapse-item" to="/expenses">All Expenses</router-link>

                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer"
                   aria-expanded="true" aria-controls="collapseCustomer">
                    <i class="fas fa-users"></i>
                    <span>Customers</span>
                </a>
                <div id="collapseCustomer" class="collapse" aria-labelledby="headingBootstrap"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <router-link class="collapse-item" to="/add-customer">Add Customer</router-link>
                        <router-link class="collapse-item" to="/customers">All Customers</router-link>

                    </div>
                </div>
            </li>


        </ul>
        <!-- Sidebar -->
    </nav>
</template>


<script>
    // import {mapGetters} from 'vuex'

    export default {
        data() {
            return {
                baseUrl: baseUrl,
            };
        }
    }
</script>

