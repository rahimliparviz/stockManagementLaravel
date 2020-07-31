<template>
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card shadow-sm my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Login </h1>
                </div>
                <form class="user" @submit.prevent="login">
                  <div class="form-group">
                    <input
                      type="email"
                      class="form-control"
                      id="exampleInputEmail"
                      aria-describedby="emailHelp"
                      placeholder="Enter Email Address"
                      v-model="form.email"
                    />
                    <small class="text-danger" v-if='errors.email'>{{errors.email[0]}}</small>
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control"
                      id="exampleInputPassword"
                      placeholder="Password"
                      v-model="form.password"
                    />
               <small class="text-danger" v-if='errors.password'>{{errors.password[0]}}</small>

                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                      <input type="checkbox" class="custom-control-input" id="customCheck" />
                      <label class="custom-control-label" for="customCheck">
                        Remember
                        Me
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <a @click="login" class="btn btn-primary btn-block text-light">Login</a>
                  </div>
                  <hr />
                </form>
                <hr />
                <div class="text-center">
                  <router-link to="/register" class="font-weight-bold small">Create an Account!</router-link>
                </div>
                <div class="text-center">
                  <router-link to="forget" class="font-weight-bold small">Forget password</router-link>
                </div>
                <div class="text-center"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>





  </div>
</template>

<script>
export default {
  data() {
    return {
      errors:{},
      form: {
        email: "admin@admin.az",
        password: "12345"
      }
    };
  },

  methods: {
    login(){
          this.$store.dispatch('login', {form:this.form,router:this.$router})
          .then(response => {
          }, error => {
                this.errors = error.data.errors;
            })
    },
  },

};
</script>
