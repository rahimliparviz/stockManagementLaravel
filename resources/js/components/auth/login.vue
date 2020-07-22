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
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control"
                      id="exampleInputPassword"
                      placeholder="Password"
                      v-model="form.password"
                    />
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


   <h1 v-if="token">{{token}}</h1>
    <h1 v-else>no token</h1>

    <p @click="setToken({'key1': 'value1', 'key2': 'value2'})">Fake button</p>

  </div>
</template>

<script>
import {mapActions,mapGetters} from 'vuex'
export default {
  data() {
    return {
      test:'test',
      form: {
        email: "admin@admin.az",
        password: "12345"
      }
    };
  },

  methods: {
    // login() {
    //   axios
    //     .post("/api/auth/login", this.form)
    //     .then(res => {
    //       console.log(res);
    //       User.responseAfterLogin(res);
    //       // Toast.fire({
    //       //   icon: "success",
    //       //   title: "Signed in successfully"
    //       // });
    //       this.$router.push({ name: "home" });
    //     })
    //     .catch(error => (this.errors = error.response.data.errors))
    //     .catch
    //     // Toast.fire({
    //     //   icon: "warning",
    //     //   title: "Invalid Email or Password"
    //     // })
    //     ();
    // },
    login(){
      this.$store.dispatch('login', this.form)
    },
    ...mapActions({
        setToken:'setToken',
        // login:'login'
    })
  },
  created() {
    console.log(this.token)
    if (this.token) {
      this.$router.push({ name: "home" });
    }
  },
  computed: {
    ...mapGetters([
      'token'
    ])
   
  },
};
</script>