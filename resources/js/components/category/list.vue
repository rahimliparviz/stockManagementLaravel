<template>

    <div>

        <div class="row">
            <router-link to="/add-category" class="btn btn-primary">Add Category</router-link>

        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">


        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="category in searchFilter" :key="category.id">
                                <td> {{ category.category_name }}</td>

                                <td>
                                    <router-link :to="{name: 'edit-category', params:{id:category.id}}"
                                                 class="btn btn-sm btn-primary">Edit
                                    </router-link>

                                    <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger"><font
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
                categories: [],
                searchTerm: ''
            }
        },
        computed: {
            searchFilter() {
                return this.categories.filter(category => {
                    console.log(category)
                    return category.category_name.match(this.searchTerm)
                })
            }
        },

        methods: {
            allCategories() {
                agent.Category.list()
                    .then((data) => {

                        this.categories = data
                    })
                    .catch()
            },
            deleteCategory(id) {
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
                        agent.Category.delete(id)
                            .then(() => {
                                this.categories = this.categories.filter(category => {
                                    return category.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name: 'category'})
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
            this.allCategories();
        }

    }
</script>

