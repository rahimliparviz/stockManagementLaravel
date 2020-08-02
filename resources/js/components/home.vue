<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Today Sell Amount</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ orders.selectedDaySell }}</div>
                                <div v-if="sellPercentage" class="mt-2 mb-0 text-muted text-xs">
                                    <span  v-bind:class="[sellPercentage > 0 ? 'text-success' : '', 'text-danger']" class="mr-2">
                                        <i v-bind:class="[sellPercentage > 0 ? 'fa-arrow-up' : '', 'fa-arrow-down']" class="fas"></i>
                                        {{sellPercentage }}%
                                    </span>
                                    <span>Since last day</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Today Income</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ orders.selectedDayIncome }}
                                </div>
                                <div v-if="incomePercentage" class="mt-2 mb-0 text-muted text-xs">
                                    <span  v-bind:class="[incomePercentage > 0 ? 'text-success' : '', 'text-danger']" class="mr-2">
                                        <i v-bind:class="[incomePercentage > 0 ? 'fa-arrow-up' : '', 'fa-arrow-down']" class="fas"></i>
                                        {{incomePercentage }}%
                                    </span>
                                    <span>Since last day</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Today Due</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">$ {{ orders.selectedDayDue }}
                                </div>
                                <div v-if="duePercentage" class="mt-2 mb-0 text-muted text-xs">
                                    <span  v-bind:class="[duePercentage > 0 ? 'text-success' : '', 'text-danger']" class="mr-2">
                                        <i v-bind:class="[duePercentage > 0 ? 'fa-arrow-up' : '', 'fa-arrow-down']" class="fas"></i>
                                        {{duePercentage }}%
                                    </span>
                                    <span>Since last day</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Today Expense</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ expenses.selectedDayExpense
                                    }}
                                </div>
                                <div v-if="expensePercentage" class="mt-2 mb-0 text-muted text-xs">
                                    <span  v-bind:class="[expensePercentage > 0 ? 'text-success' : '', 'text-danger']" class="mr-2">
                                        <i v-bind:class="[expensePercentage > 0 ? 'fa-arrow-up' : '', 'fa-arrow-down']" class="fas"></i>
                                        {{expensePercentage }}%
                                    </span>
                                    <span>Since last day</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Out Of Stock Product</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Photo</th>

                                <th>Buying Price</th>
                                <th>Status</th>
                                <th>Quantity</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in products" :key="product.id">
                                <td> {{ product.product_name }}</td>
                                <td> {{ product.product_code }}</td>
                                <td><img :src="product.image" id="photo"></td>

                                <td>{{ product.buying_price }}</td>
                                <td v-if="product.product_quantity  >= 1 "><span
                                    class="badge badge-success">Available </span></td>
                                <td v-else><span class="badge badge-danger">Stock Out </span></td>
                                <td>{{ product.product_quantity }}</td>

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
                orders: {
                    dayBeforeDue: 0,
                    dayBeforeIncome: 0,
                    dayBeforeSell: 0,
                    selectedDayDue: 0,
                    selectedDayIncome: 0,
                    selectedDaySell: 0,
                },
                expenses: {
                    dayBeforeExpense: 0,
                    selectedDayExpense: 0
                },
                products: {}
            }
        },
        computed: {
            sellPercentage() {
                return this.calculatePercentage(this.orders.dayBeforeSell, this.orders.selectedDaySell);

            },
            incomePercentage() {
                return this.calculatePercentage(this.orders.dayBeforeIncome, this.orders.selectedDayIncome);

            },
            duePercentage() {
                return this.calculatePercentage(this.orders.dayBeforeDue, this.orders.selectedDayDue);

            },
            expensePercentage() {
                return this.calculatePercentage(this.orders.dayBeforeExpense, this.orders.selectedDayExpense);

            }
        },
        mounted() {
            this.dateReports()
            this.stockOut();
        },
        methods: {
            calculatePercentage(originalValue, newValue) {
                if (newValue && originalValue) {
                    let change = newValue - originalValue
                    return Math.round(change * 100 / originalValue)
                }
            },

            dateReports() {
                agent.Reports.dateReports().then((data) => {
                    const {orders, expenses} = data;
                    this.orders = orders
                    this.expenses = expenses
                })
                    .catch()
            },

            stockOut() {
                agent.Reports.stockOut()
                    .then((data) => (this.products = data))
                    .catch()
            },
        }
    }
</script>
