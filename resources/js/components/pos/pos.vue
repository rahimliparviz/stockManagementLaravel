
<template>

  <div>
   <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">POS</li>
            </ol>
          </div>

          <div class="row mb-3">


            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
         <a class="btn btn-sm btn-info"><font color="#ffffff">Add Customer</font></a>

                </div>





                <div class="table-responsive" style="font-size: 12px;">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

          <tr v-for="cart in carts" :key="cart.id">
            <td>{{ cart.product_name }}</td>
            <td><input type="text" readonly="" style="width: 15px;" :value="cart.product_quantity">
       <button @click.prevent="increment(cart.id);cart.product_quantity++" class="btn btn-sm btn-success">+</button>
   <button  @click.prevent="decrement(cart.id)" class="btn btn-sm btn-danger" v-if="cart.product_quantity >= 2">-</button>
   <button class="btn btn-sm btn-danger" v-else="" disabled="">-</button>

            </td>
            <td>{{ cart.product_price  }}</td>
            <td>{{ cart.sub_total }}</td>
   <td><a @click="removeItem(cart.id)" class="btn btn-sm btn-primary"><font color="#ffffff">X</font></a></td>
          </tr>


                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
            <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
  <strong>{{ productsQuantity }}</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
  <strong>{{ subTotal }} $</strong>
   </li>

     <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
  <strong>{{ vat }} %</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Total :
  <strong>{{ subTotal*vat /100 + subTotal}} $</strong>
   </li>

            </ul>
            <br>

        <form @submit.prevent="submitOrder">
          <label>Customer Name</label>
          <select class="form-control" v-model="customerId">
         <option :value="customer.id" v-for="customer in customers">{{customer.name }} </option>

           </select>

           <label>Pay</label>
           <input type="text" class="form-control" required="" v-model="pay">

           <label>Due</label>
           <input type="text" class="form-control" required="" v-model="due">

          <label>Pay By</label>
          <select class="form-control" v-model="payBy">
                 <option value="HandCash">Hand Cash </option>
                 <option value="Cheaque">Cheaque </option>
                 <option value="GiftCard">Gift Card </option>
           </select>

           <br>
           <button type="submit" class="btn btn-success">Submit</button>

        </form>



                </div>







              </div>
            </div>
            <!-- Pie Chart -->



            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                  </div>

   <!--  Category Wise Product -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product </a>
  </li>


  <li class="nav-item" v-for="category in categories" :key="category.id">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"
       @click="getCategoryProducts(category.id)" >{{ category.category_name }}</a>
  </li>



</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

<div class="card-body">
 <input type="text" v-model="searchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">

     <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in productSearch" :key="product.id">
             <button class="btn btn-sm" @click.prevent="addToCart(product.id)">
             <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
              <img :src="product.image" id="em_photo" class="card-img-top">
              <div class="card-body">
                <h6 class="card-title">{{ product.product_name }}</h6>
       <span class="badge badge-success" v-if="product.product_quantity  >= 1 ">Available {{ product.product_quantity }}  </span>
    <span class="badge badge-danger" v-else=" ">Stock Out </span>

              </div>
            </div></button>

        </div>
      </div>

     </div>


  </div>  <!--  End TBAS HOME -->





  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


<input type="text" v-model="categoryProductSearchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">

     <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="categoryProduct in categoryProductSearch" :key="categoryProduct.id">
            <button class="btn btn-sm" @click.prevent="addToCart(categoryProduct.id)">
             <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
              <img :src="categoryProduct.image" id="em_photo" class="card-img-top">
              <div class="card-body">
                <h6 class="card-title">{{ categoryProduct.product_name }}</h6>
       <span class="badge badge-success" v-if="categoryProduct.product_quantity  >= 1 ">Available {{ categoryProduct.product_quantity }}  </span>
    <span class="badge badge-danger" v-else=" ">Stock Out </span>

              </div>
            </div></button>

        </div>
      </div>




  </div>

</div>
<!-- End Category Wise Product -->






                </div>

              </div>
            </div>



          </div>
          <!--Row-->



        </div>
  </div>


</template>



<script type="text/javascript">
    import {mapGetters} from 'vuex'
    import agent from "../../api/agent";
    import order from "../order/order";


    export default {


    created(){
        if (!this.token) {
            this.$router.push({ name: "/" });
        }



    this.allProduct();
    this.allCategory();
    this.allCustomer();
    this.cartProduct();
    this.getVat();
    Reload.$on('AfterAdd',() =>{
      this.cartProduct();
    })

   },
 data(){
      return{
        customerId:'',
        pay:'',
        due:'',
        payBy:'',
        products:[],
        categories:'',
        categoryProducts:[],
        searchTerm:'',
        categoryProductSearchTerm:'',
        customers:'',
        errors:'',
        carts:[],
        vat:''

      }
    },
    computed:{

        ...mapGetters([
            'token'
        ]),


      productSearch(){
      return this.products.filter(product => {
         return product.product_name.match(this.searchTerm)
      })
      },
       categoryProductSearch(){
      return this.categoryProducts.filter(categoryProduct => {
         return categoryProduct.product_name.match(this.categoryProductSearchTerm)
       })
      },
   productsQuantity(){
    let sum = 0;
    for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].product_quantity));
        }
        return sum;
   },
   subTotal(){
    let sum = 0;
    for(let i = 0; i < this.carts.length; i++){
    sum += (parseFloat(this.carts[i].product_quantity) * parseFloat(this.carts[i].product_price));
        }
       return sum;

      },

    },

  methods:{
    // Cart Methods Here
  addToCart(id){
      agent.Cart.add(id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.addedToCart()
      })
      .catch()
  },
  cartProduct(){
      agent.Cart.products()
      .then((data) => {
          this.carts = data
      })
      .catch()
  },
  removeItem(id){
      agent.Cart.remove(id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.cart_delete()
      })
      .catch()
  },
  increment(id){
      agent.Cart.increment(id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.success()
      })
      .catch()
  },
      decrement(id){
       agent.Cart.decrement(id)

       // axios.get('/api/decrement/'+id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.success()
      })
      .catch()
  },
  getVat(){
      agent.Regulations.get()
      .then((regulation) => {
          (this.vat = regulation.vat)
      })
      .catch()
  },
  submitOrder(){
    let total = this.subTotal*this.vat /100 + this.subTotal;
    let data = {
        productsQuantity:this.productsQuantity,
        subTotal:this.subTotal,
        customerId:this.customerId,
        payBy:this.payBy,
        pay:this.pay,
        due:this.due,
        vat:this.vat,
        total:total
    }

    agent.Pos.submitOrder(data)
    // axios.post('/api/orderdone',data)
       .then(() => {
          Notification.success()
         // this.$router.push({name: 'home'})
       })

  },

    // End Cart Methods
    allProduct(){
        agent.Product.list()

        // axios.get('/api/product/')
      .then((data) => (this.products = data))
      .catch()
    },
     allCategory(){
         agent.Category.list()

         // axios.get('/api/category/')
      .then((data) => (this.categories = data))
      .catch()
    },
    allCustomer(){
      agent.Customer.list()
      // axios.get('/api/customer/')
      .then((data) => (this.customers = data))
      .catch(console.log('error'))
    },
    getCategoryProducts(id){
      agent.Pos.categoryProduct(id)
      // axios.get('/api/getting/product/'+id)
      .then((data) => (this.categoryProducts = data))
      .catch()
    }


    }

  }

</script>


<style type="text/css" scoped>
  #em_photo{
    height: 100px;
    width: 135px;
  }
</style>
