<template>
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card shadow-sm my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Register</h1>
                </div>
                <form @submit.prevent="register">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      id="exampleInputFirstName"
                      placeholder="Enter Full Name"
                      v-model="form.name"
                    />
                    <small class="text-danger" v-if='errors.name'>{{errors.name[0]}}</small>
                                   <!-- <small class="text-danger" v-if='errors.password'>{{errors.password[0]}}</small> -->

                  </div>

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
                    <input
                      type="password"
                      class="form-control"
                      id="exampleInputPasswordRepeat"
                      placeholder="Confirm Password"
                      v-model="form.password_confirmation"
                    />

                  </div>
                  <div class="form-group" @click='register'>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                  </div>
                  <hr />
                </form>
                <hr />
                <div class="text-center">
                  <router-link to="/" class="font-weight-bold small">Already have an account?</router-link>
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
import {mapGetters} from 'vuex'
export default {
  data() {
    return {
      errors:{},
      form: {
        name:'Nocolay hell',
        email: "admin@admin.az",
        password: "123456",
        password_confirmation:"123456",
      }
    };
  },

  methods: {
    register(){
          this.$store.dispatch('register', {form:this.form,router:this.$router})
          .then(response => {}, error => {
            console.log(error)
                this.errors = error.data.errors;
            })
    },
  },
  created() {
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