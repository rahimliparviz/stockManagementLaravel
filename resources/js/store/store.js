import Vue from "vue";
import Vuex from "vuex";
import agent from "../api/agent";

Vue.use(Vuex)

export const store = new Vuex.Store({
    state:{
        user:null,
        token:null
    },
    getters:{
        user: state=>{
            return state.user
        },
        token: state=>{
            return state.token
        },
        
    },mutations:{
        setToken: (state,payload)=>{
            state.token = payload
        },
        login:(state,payload)=>{
            state.token = payload.access_token
            console.log(state.token, payload.access_token)
        }
    },
    actions:{
        setToken:({commit},payload)=>{
            commit('setToken',payload.key2)
        },

        login:({commit},payload)=>{

            agent.User.login(payload)
            .then(res => {
                commit('login',res)          
            }).catch(err =>{
                console.log(err)
            })
        
        },
        
   
    }
})