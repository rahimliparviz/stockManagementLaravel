/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import sideBar from './components/layout/sideBar'
import topBar from './components/layout/topBar.vue'
import {store} from './store/store'
import router from './router/roter';
import agent from "./api/agent";


//Axios agent
window.agent = agent;


//Notification
import Notification from './helpers/Notification'
window.Notification = Notification;
 // Sweet Alert start
 import Swal from 'sweetalert2'
 window.Swal = Swal;



 const Toast = Swal.mixin({
   toast: true,
   position: 'top-end',
   showConfirmButton: false,
   timer: 3000,
   timerProgressBar: true,
   onOpen: (toast) => {
     toast.addEventListener('mouseenter', Swal.stopTimer)
     toast.addEventListener('mouseleave', Swal.resumeTimer)
   }
 });

 window.Toast = Toast;
 window.baseUrl = window.location.origin;

 // Sweet Alert End



//   )
 const app = new Vue({
    el: '#app',
    router,
    store,
    components:{
      'sidebar':sideBar,
      'topbar':topBar,
    },
});

