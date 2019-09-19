import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/index'
// import './registerServiceWorker'



import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSweetalert2 from 'vue-sweetalert2';
import VueSlimScroll from 'vue-slimscroll'
import VeeValidate from 'vee-validate';
import VueLocalForage from 'vue-localforage';
import DatatableFactory from 'vuejs-datatable/dist/vuejs-datatable.esm.js';

import 'roboto-fontface/css/roboto/roboto-fontface.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './style.css'


import AuthLayout from "./layouts/AuthLayout.vue";


Vue.component("auth-layout", AuthLayout);

Vue.use(VueAxios, axios)
Vue.use(VueSweetalert2)
Vue.use(VueSlimScroll)
Vue.use(VeeValidate);
Vue.use(VueLocalForage);
Vue.use(DatatableFactory);

Vue.config.productionTip = false

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')