<template>

  <div>

 <div class="row">
  <router-link to="/product" class="btn btn-primary">All Product </router-link>

 </div>



    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Product</h1>
                  </div>

      <form class="user" @submit.prevent="ProductInsert" enctype="multipart/form-data">

        <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1">Product Name</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Product Name" v-model="form.product_name">
       <small class="text-danger" v-if="errors.product_name"> {{ errors.product_name[0] }} </small>
            </div>


     <div class="col-md-6">
      <label for="exampleFormControlSelect1">Product Code</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Product Code" v-model="form.product_code">
         <small class="text-danger" v-if="errors.product_code"> {{ errors.product_code[0] }} </small>
            </div>

          </div>
        </div>


         <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
      <label for="exampleFormControlSelect1">Product Category</label>
  <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id">
     <option :value="category.id" v-for="category in categories">{{ category.category_name }}</option>

                      </select>
               <small class="text-danger" v-if="errors.category_id"> {{ errors.category_id[0] }} </small>

            </div>


     <div class="col-md-6">
          <label for="exampleFormControlSelect1">Product Supplier</label>
 <select class="form-control" id="exampleFormControlSelect1" v-model="form.supplier_id">

    <option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>

                      </select>
               <small class="text-danger" v-if="errors.supplier_id"> {{ errors.supplier_id[0] }} </small>


            </div>

          </div>
        </div>




 <div class="form-group">

          <div class="form-row">
            <div class="col-md-4">
              <label for="exampleFormControlSelect1">Product Root</label>
         <input type="text" class="form-control" id="exampleInputFirstName"  v-model="form.root">
       <small class="text-danger" v-if="errors.root"> {{ errors.root[0] }} </small>
            </div>


 <div class="col-md-4">
              <label for="exampleFormControlSelect1">Buying Price</label>
         <input type="text" class="form-control" id="exampleInputFirstName"  v-model="form.buying_price">
       <small class="text-danger" v-if="errors.buying_price"> {{ errors.buying_price[0] }} </small>
            </div>



     <div class="col-md-4">
      <label for="exampleFormControlSelect1">Selling Price</label>
         <input type="text" class="form-control" id="exampleInputFirstName" v-model="form.selling_price">
         <small class="text-danger" v-if="errors.selling_price"> {{ errors.selling_price[0] }} </small>
            </div>

          </div>
        </div>








        <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1">Buying Date</label>
         <input type="date" class="form-control" id="exampleInputFirstName" v-model="form.buying_date">
  <small class="text-danger" v-if="errors.buying_date"> {{ errors.buying_date[0] }} </small>
            </div>


     <div class="col-md-6">
      <label for="exampleFormControlSelect1">Product Quantity</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Quantity" v-model="form.product_quantity">
         <small class="text-danger" v-if="errors.product_quantity"> {{ errors.product_quantity[0] }} </small>
            </div>

          </div>
        </div>






         <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
   <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">

  <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0] }} </small>
       <label class="custom-file-label" for="customFile">Choose file</label>
            </div>


     <div class="col-md-6">
        <img :src="form.photo" style="height: 40px; width: 40px;">
            </div>

          </div>
        </div>




        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>

      </form>
                  <hr>
                  <div class="text-center">


                  </div>
                  <div class="text-center">
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

    data(){
    return {
     form:{
        product_name: 'alma',
        product_code: '1aa',
        category_id: null,
        supplier_id: null,
        root: null,
        buying_price: null,
        selling_price: null,
        buying_date: null,
        photo: null,
        product_quantity: null
      },
      errors:{},
      categories:{},
      suppliers:{},

    }
  },
  methods:{
    onFileSelected(event){
        console.log('dsadwqd')
     let file = event.target.files[0];
     if (file.size > 1048770) {
      Notification.image_validation()
     }else{
      let reader = new FileReader();
      reader.onload = event =>{
        this.form.photo = event.target.result
          console.log(this.form);
      };
      reader.readAsDataURL(file);
     }
    },
ProductInsert(){
  agent.Product.create(this.form)
      //  axios.post('/api/product',this.form)
       .then(() => {
        this.$router.push({ name: 'products'})
        Notification.success()
       })
       .catch(error =>this.errors = error.data.errors)
     },
  },
  created(){
    agent.Category.list()
    .then((data) => (this.categories = data))
    agent.Supplier.list()
    .then((data) => (this.suppliers = data))
  }
  }

</script>

