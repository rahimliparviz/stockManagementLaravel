<template>

    <div>

        <div class="row">
            <router-link to="/orders" class="btn btn-primary">Go Back</router-link>

        </div>


        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> Order Details </h1>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Order Details </h6>
                                                </div>
                                                <div class="table-responsive">

                                                    <ul class="list-group">
                                                        <li class="list-group-item"><b>Name :</b> {{ order.customer.name }}</li>
                                                        <li class="list-group-item"><b>Phone :</b> {{ order.customer.phone}}
                                                        </li>
                                                        <li class="list-group-item"><b>Address :</b> {{ order.customer.address
                                                            }}
                                                        </li>
                                                        <li class="list-group-item"><b>Date :</b> {{ order.created_at }}
                                                        </li>
                                                        <li class="list-group-item"><b>Pay Through :</b> {{ order.payBy
                                                            }}
                                                        </li>
                                                    </ul>


                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                                                </div>
                                                <div class="table-responsive">


                                                    <ul class="list-group">
                                                        <li class="list-group-item"><b>Price:</b> {{order.price }} $
                                                        </li>
                                                        <li class="list-group-item"><b>Price with vat :</b> {{ order.price_with_vat }} $
                                                        </li>
                                                        <li class="list-group-item"><b>Pay Amount :</b> {{ order.pay }}
                                                            $
                                                        </li>
                                                        <li class="list-group-item"><b>Due Amount :</b> {{ order.due }}
                                                            $
                                                        </li>
                                                    </ul>


                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>Product Name</th>
                                                            <th>Product Code</th>
                                                            <th>Image</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Price</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="orderProduct in order.order_products">
                                                            <td>{{ orderProduct.product.product_name }}</td>
                                                            <td>{{ orderProduct.product.product_code }}</td>
                                                            <td><img :src="'/'+orderProduct.product.image" id="photo"></td>
                                                            <td>{{ orderProduct.quantity }}</td>
                                                            <td>{{ orderProduct.product.product_price }} $</td>
                                                            <td>{{ orderProduct.price }} $</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>


<script type="text/javascript">


    export default {

        data() {
            return {
                order: {},
            }
        },
        created() {
            agent.Order.order(this.$route.params.id)
                .then((data) => {
                    (this.order = data)
                })

        },

        methods: {}


    }

</script>


<style type="text/css">
    #photo {
        height: 40px;
        width: 40px;
    }
</style>
