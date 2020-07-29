<template>
    <nav >

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
                <i class="fas fa-fw fa-tachometer-alt"></i>
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
          <span>Empoyess</span>
        </a>
        <div id="collapseEmployee" class="collapse" aria-labelledby="headingEmployee" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" to="/add-employee">Add Employee</router-link>
            <router-link class="collapse-item" to="/employees">All Employees</router-link>
          </div>
        </div>
      </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupplier"
          aria-expanded="true" aria-controls="collapseSupplier">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Suppliers</span>
        </a>
        <div id="collapseSupplier" class="collapse" aria-labelledby="headingSupplier" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
             <router-link class="collapse-item" to="/add-supplier">Add Supplier</router-link>
            <router-link class="collapse-item" to="/suppliers">All Suppliers</router-link>

          </div>
        </div>
      </li>


<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap5"
          aria-expanded="true" aria-controls="collapseBootstrap5">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Salary</span>
        </a>
        <div id="collapseBootstrap5" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

   <router-link class="collapse-item" to="/given-salary">Add Salary</router-link>
   <router-link class="collapse-item" to="/salary">All Salary</router-link>

          </div>
        </div>
      </li>





<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap51"
          aria-expanded="true" aria-controls="collapseBootstrap51">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Orders</span>
        </a>
        <div id="collapseBootstrap51" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

   <router-link class="collapse-item" to="/order">Today Order</router-link>
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
        <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

   <router-link class="collapse-item" to="/add-category">Add Category</router-link>
   <router-link class="collapse-item" to="/category">All Category</router-link>

          </div>
        </div>
      </li>






<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
          aria-expanded="true" aria-controls="collapseProducts">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Products</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

   <router-link class="collapse-item" to="/add-product">Add Product</router-link>
   <router-link class="collapse-item" to="/product">All Product</router-link>

          </div>
        </div>
      </li>






<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap4"
          aria-expanded="true" aria-controls="collapseBootstrap4">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Expense</span>
        </a>
        <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

   <router-link class="collapse-item" to="/add-expense">Add Expense</router-link>
   <router-link class="collapse-item" to="/expense">All Expense</router-link>

          </div>
        </div>
      </li>





<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap44"
          aria-expanded="true" aria-controls="collapseBootstrap44">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Customers</span>
        </a>
        <div id="collapseBootstrap44" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

   <router-link class="collapse-item" to="/add-customer">Add Customer</router-link>
   <router-link class="collapse-item" to="/customer">All Customer</router-link>

          </div>
        </div>
      </li>














      <li class="nav-item">
        <a class="nav-link" href="forms.html">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Forms</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tables</h6>
            <a class="collapse-item" href="simple-tables.html">Simple Tables</a>
            <a class="collapse-item" href="datatables.html">DataTables</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ui-colors.html">
          <i class="fas fa-fw fa-palette"></i>
          <span>UI Colors</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Examples
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true"
          aria-controls="collapsePage">
          <i class="fas fa-fw fa-columns"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Example Pages</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    </nav>
</template>


 <script>
// import {mapGetters} from 'vuex'

export default {
    data() {
    return {
      baseUrl:baseUrl,
    };
  }
}
</script>

