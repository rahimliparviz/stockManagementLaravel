<template>

    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
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

                                <tr v-for="orderProduct in orderProducts" :key="orderProduct.id">
                                    <td>{{ orderProduct.product_name }}</td>
                                    <td><input type="text" readonly="" style="width: 30px;"
                                               :value="orderProduct.selected_quantity">
                                        <button @click.prevent="increment(orderProduct.id);"
                                                class="btn btn-sm btn-success">+
                                        </button>
                                        <button @click.prevent="decrement(orderProduct.id)" class="btn btn-sm btn-danger"
                                                >-
                                        </button>
<!--                                        <button class="btn btn-sm btn-danger" v-else="" disabled="">-</button>-->

                                    </td>
                                    <td>{{ orderProduct.selling_price }}</td>
                                    <td>{{ orderProduct.selected_quantity * orderProduct.selling_price}}</td>
                                    <td><a @click="removeItem(orderProduct.id)" class="btn btn-sm btn-primary"><font
                                        color="#ffffff">X</font></a></td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Total
                                    Quantity:
                                    <strong>{{ productsQuantity }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
                                    <strong>{{ price }} $</strong>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
                                    <strong>{{ vat }} %</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Total price:
                                    <strong>{{ price * vat /100 + price}} $</strong>
                                </li>

                            </ul>
                            <br>

                            <form @submit.prevent="submitOrder">
                                <label>Customer Name</label>
                                <select class="form-control" v-model="customerId">
                                    <option :value="customer.id" v-for="customer in customers">{{customer.name }}
                                    </option>

                                </select>

                                <label>Pay</label>
                                <input type="text" class="form-control" required="" v-model="pay">

                                <label>Due</label>
                                <input type="text" class="form-control" required="" v-model="due">

                                <label>Pay By</label>
                                <select class="form-control" v-model="payBy">
                                    <option value="HandCash">Hand Cash</option>
                                    <option value="Cheaque">Cheaque</option>
                                    <option value="GiftCard">Gift Card</option>
                                </select>
                                <small class="text-danger" v-if="errors.payBy"> {{ errors.payBy[0] }} </small>


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
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">All Product </a>
                            </li>


                            <li class="nav-item" v-for="category in categories" :key="category.id">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                   aria-controls="profile" aria-selected="false"
                                   @click="getCategoryProducts(category.id)">{{ category.category_name }}</a>
                            </li>


                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="card-body">
                                    <input type="text" v-model="searchTerm" class="form-control" style="width: 560px;"
                                           placeholder="Search Product">

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in productSearch"
                                             :key="product.id">
                                            <button class="btn btn-sm" @click.prevent="addToCart(product)">
                                                <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                    <img :src="product.image" id="photo" class="card-img-top">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ product.product_name }}</h6>
                                                        <span class="badge badge-success"
                                                              v-if="product.product_quantity  >= 1 ">Available {{ product.product_quantity }}  </span>
                                                        <span class="badge badge-danger" v-else>Stock Out </span>

                                                    </div>
                                                </div>
                                            </button>

                                        </div>
                                    </div>

                                </div>


                            </div>  <!--  End TBAS HOME -->


                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                                <input type="text" v-model="categoryProductSearchTerm" class="form-control"
                                       style="width: 560px;" placeholder="Search Product">

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6"
                                         v-for="categoryProduct in categoryProductSearch" :key="categoryProduct.id">
                                        <button class="btn btn-sm" @click.prevent="addToCart(categoryProduct)">
                                            <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                <img :src="categoryProduct.image" id="photo" class="card-img-top">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ categoryProduct.product_name }}</h6>
                                                    <span class="badge badge-success"
                                                          v-if="categoryProduct.product_quantity  >= 1 ">Available {{ categoryProduct.product_quantity }}  </span>
                                                    <span class="badge badge-danger" v-else>Stock Out </span>

                                                </div>
                                            </div>
                                        </button>

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


</template>


<script type="text/javascript">


    export default {


        created() {
            this.allProduct();
            this.allCategory();
            this.allCustomer();
            this.getVat();

        },
        data() {
            return {
                customerId: '1',
                pay: '5',
                due: '1',
                payBy: '',
                products: [],
                categories: '',
                categoryProducts: [],
                searchTerm: '',
                categoryProductSearchTerm: '',
                customers: '',
                errors: '',
                orderProducts: [],
                vat: ''

            }
        },
        computed: {

            productSearch() {
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)
                })
            },
            categoryProductSearch() {
                return this.categoryProducts.filter(categoryProduct => {
                    return categoryProduct.product_name.match(this.categoryProductSearchTerm)
                })
            },
            productsQuantity() {
                let sum = 0;
                for (let i = 0; i < this.orderProducts.length; i++) {
                    sum += (parseFloat(this.orderProducts[i].selected_quantity));
                }
                return sum;
            },
            price() {
                let sum = 0;
                for (let i = 0; i < this.orderProducts.length; i++) {
                    sum += (parseFloat(this.orderProducts[i].selected_quantity) * parseFloat(this.orderProducts[i].selling_price));
                }
                return sum;

            },


        },

        methods: {
            // Cart Methods Here
            addToCart(product) {

                if (this.orderProducts.some(p => p.id == product.id)) {
                    Notification.itemExist("Product")
                }
                else if(product.product_quantity == 0){
                    Notification.stockOutForProduct(product.product_name)
                }
                else{
                    product.selected_quantity = 0;
                    this.orderProducts.push(product)
                    this.increment(product.id)

                }

            },
            removeItem(id) {
                let index = this.orderProducts.findIndex(c=>c.id == id)
                let productInCart = this.orderProducts.find(c=>c.id == id);
                let product = this.products.find(p=>p.id == id);
                product.product_quantity+=productInCart.selected_quantity;
                this.$delete(this.orderProducts,index)

            },
            increment(id) {

                let index = this.orderProducts.findIndex(c=>c.id == id)
                let productInCart = this.orderProducts.find(c=>c.id == id);
                let product = this.products.find(p=>p.id == id);

                if(productInCart.product_quantity != 0){
                    productInCart.selected_quantity ++;
                    product.product_quantity --;
                    this.$set(this.orderProducts, index, productInCart)
                }

            },
            decrement(id) {
                let index = this.orderProducts.findIndex(c=>c.id == id)
                let productInCart = this.orderProducts.find(c=>c.id == id);
                let product = this.products.find(p=>p.id == id);

                if(productInCart.selected_quantity > 0){
                    productInCart.selected_quantity --;
                    product.product_quantity ++;
                    this.$set(this.orderProducts, index, productInCart)

                }
            },
            getVat() {
                agent.Regulations.get()
                    .then((regulation) => {
                        (this.vat = regulation.vat)
                    })
                    .catch()
            },
            submitOrder() {
                let priceWithVat = this.price * this.vat / 100 + this.price;
                let data = {
                    productsQuantity: this.productsQuantity,
                    price: this.price,
                    customerId: this.customerId,
                    payBy: this.payBy,
                    pay: this.pay,
                    due: this.due,
                    priceWithVat: priceWithVat,
                    orderProducts:this.orderProducts
                }
                console.log(this.orderProducts.length,this.orderProducts,this.orderProducts.length < 1)
                if (this.orderProducts.length < 1){
                    Notification.warning('You have to select at least on product')

                }else {

                    agent.Order.submitOrder(data)
                        .then((res) => {
                            if (res.status == 'success') {
                                this.resetData();
                                Notification.success()
                            } else {
                                Notification.warning()
                            }

                        })
                        .catch(error =>this.errors = error.data.errors)

                }
            },

            resetData(){
                    this.customerId= '',
                    this.pay= '',
                    this.due= '',
                    this.payBy= '',
                    this.searchTerm= '',
                    this.categoryProductSearchTerm= '',
                    this.errors= '',
                    this.orderProducts= [],
                    this.vat= ''
            },

            // End Cart Methods
            allProduct() {
                agent.Product.list()

                    .then((data) => (this.products = data))
                    .catch()
            },
            allCategory() {
                agent.Category.list()

                    .then((data) => (this.categories = data))
                    .catch()
            },
            allCustomer() {
                agent.Customer.list()
                    .then((data) => (this.customers = data))
                    .catch((e)=>console.log(e))
            },
            getCategoryProducts(id) {
                this.categoryProducts = this.products.filter(pro=>pro.category_id == id);
            }


        }

    }

</script>


<style type="text/css" scoped>
    #photo {
        height: 100px;
        width: 135px;
    }
</style>
