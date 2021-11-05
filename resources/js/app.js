/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Form from 'vform';
window.Form = Form;
import VueRouter from 'vue-router';

import swal from 'sweetalert2';

Vue.use(require('vue-moment'));
window.swal = swal;
const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.toast = toast;
Vue.use(VueRouter);

let routes = [
    { path: '/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/product', component: require('./components/admin/Product.vue').default},
    { path: '/vendors', component: require('./components/Admin/Vendor.vue').default},
    { path: '/assignedorders', component: require('./components/Admin/AssignedOrder.vue').default},
    { path: '/clients', component: require('./components/Admin/Client.vue').default},
    { path: '/clientlocation', component: require('./components/Admin/ClientLocation.vue').default},
    { path: '/orders', component: require('./components/Admin/Order.vue').default},
    { path: '/payments', component: require('./components/Admin/Payment.vue').default},
    { path: '/riders', component: require('./components/Admin/Rider.vue').default},
    { path: '/ridercurrentlocation', component: require('./components/Admin/RidercurrentLocation.vue').default},
    { path: '/trips', component: require('./components/Admin/Trip.vue').default},
    { path: '/stocks', component: require('./components/Admin/Stock.vue').default},
    { path: '/purchaseorders', component: require('./components/Admin/PurchaseOrder.vue').default}
  ];

  const router = new VueRouter({
      mode: 'history',
    routes // short for `routes: routes`
  });
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dashboard', require('./components/admin/Dashboard.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
