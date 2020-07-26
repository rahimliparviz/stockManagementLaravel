import Vue from "vue";
import Vuex from "vuex";
import agent from "../api/agent";
import Token from "../helpers/Token";
import router from '../router/roter'


Vue.use(Vuex)

export const store = new Vuex.Store({
    state:{
        user:localStorage.getItem('user'),
        token: localStorage.getItem('token')
    },
    getters:{
        user: state=>{
            return state.user
        },
        token: state=>{
            return state.token
        },
        
    },mutations:{

        //Auth
        login:(state,payload)=>{
           
            if(Token.isValid(payload.res.access_token)){
                state.token = payload.res.access_token
                localStorage.setItem('token',payload.res.access_token)
                state.user = payload.res.user;
                localStorage.setItem('user',payload.res.user)

                payload.router.push({ name: "home" })
                Toast.fire({
                    icon:'success',
                    title:'Signed in successfully!'
                })
            }else{
                Toast.fire({
                    icon:'warning',
                    title:'Token is invalid!'
                })
            }

        },
        logout:(state)=>{
            state.token = null;
            state.user = null;
            localStorage.removeItem('token')
            localStorage.removeItem('user')

            Toast.fire({
                icon:'success',
                title:'Logout successfully!'
            })
        },
        //Auth end

        //Employee
        // createEmployee:(state,payload)=>{
        // console.log(payload)
        // },

        // getEmployees:()=>{

        // }
        //Employee end

    },
    actions:{
      //Auth
        login: ({ commit }, payload)=> {
            return new Promise((resolve, reject) => {
                agent.User.login(payload.form)
                .then(res => {
                    commit('login',{res:res,router:payload.router});
                resolve();
              }, (error) => reject(error));
            });
          },
          register: ({ commit }, payload)=> {
            return new Promise((resolve, reject) => {
                agent.User.register(payload.form)
                .then(res => {
                    commit('login',{res:res,router:payload.router});
                resolve();
              }, (error) => reject(error));
            });
          },
          //Auth end

          //Employee 
        //   createEmployee: ({ commit }, payload)=> {
        //     return new Promise((resolve, reject) => {
        //         // console.log(payload)
        //         agent.Employee.create(payload)
        //         .then(res => {
        //             // console.log(res)
        //             commit('createEmployee',{res:res});
        //         resolve();
        //       }, (error) => {
        //         //   console.log(error)
        //         reject(error)
        //       });
        //     });
        //   },

        //   getEmployees: ({ commit })=>{
        //     return new Promise((resolve, reject) => {
        //         agent.Employee.list()
        //         .then(res => {
        //             commit('');
        //         resolve();
        //       }, (error) => {
        //         reject(error)
        //       });
        //     });
        //   }

          //Employee end
    }
})