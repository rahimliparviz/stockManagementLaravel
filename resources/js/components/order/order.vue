<template>

    <div>


        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">


        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Today Orders</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Total Amount</th>
                                <th>Pay</th>
                                <th>Due</th>
                                <th>PayBy</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order in searchFilter" :key="order.id">
                                <td> {{ order.customer.name }}</td>
                                <td> {{ order.price_with_vat }} $</td>
                                <td> {{ order.pay }} $</td>
                                <td> {{ order.due }} $</td>
                                <td> {{ order.payBy }}</td>

                                <td>
                                    <router-link :to="{name: 'view-order', params:{id:order.id}}"
                                                 class="btn btn-sm btn-primary">View
                                    </router-link>


                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <!--Row-->


    </div>


</template>


<script type="text/javascript">

    export default {

        data() {
            return {
                orders: [],
                searchTerm: ''
            }
        },
        computed: {
            searchFilter() {
                return this.orders.filter(order => {
                    return order.customer.name.match(this.searchTerm)
                })
            }
        },

        methods: {
            allOrder() {
                agent.Order.list()
                    .then((data) => (this.orders = data))
                    .catch()
            },


        },
        created() {
            this.allOrder();
        }


    }
</script>

