<template>

    <div>

        <div class="row">
            <router-link to="/add-expense" class="btn btn-primary">Add Expense</router-link>

        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">


        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Expense List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Details</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="expense in searchFilter" :key="expense.id">
                                <td> {{ expense.details }}</td>
                                <td> {{ expense.amount }}</td>
                                <td> {{ expense.created_at }}</td>

                                <td>
                                    <router-link :to="{name: 'edit-expense', params:{id:expense.id}}"
                                                 class="btn btn-sm btn-primary">Edit
                                    </router-link>

                                    <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger"><font
                                        color="#ffffff">Delete</font></a>
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
                expenses: [],
                searchTerm: ''
            }
        },

        computed: {

            searchFilter() {
                return this.expenses.filter(expense => {
                    return expense.created_at.match(this.searchTerm)
                })
            }
        },

        methods: {
            allExpense() {
                agent.Expense.list()
                    .then((data) => (this.expenses = data))
                    .catch()
            },
            deleteExpense(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        agent.Expense.delete(id)
                            .then(() => {
                                this.expenses = this.expenses.filter(expense => {
                                    return expense.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'expense'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            }
        },
        created() {
            this.allExpense();
        }

    }
</script>


