require('./bootstrap');

window.Vue = require('vue');
import  Vue from 'vue'
import  VueRouter from 'vue-router';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueRouter);


Vue.config.productionTip = false
Vue.use(VueSweetalert2);

import vuetify from './plugin/vuetify';
Vue.use(vuetify)

require('./global-components');

import routes from './routes'
axios.defaults.baseURL = '/api/'


Vue.component('admin-layout', require('./Main.vue').default);

Vue.component('TeacherNavigation', require('./Pages/Navigation/TeacherNavigation.vue').default);
Vue.component('SuperadminNavigation', require('./Pages/Navigation/SuperadminNavigation.vue').default);
Vue.component('FinanceNavigation', require('./Pages/Navigation/FinanceNavigation.vue').default);
Vue.component('StaffNavigation', require('./Pages/Navigation/StaffNavigation.vue').default);
Vue.component('ParentNavigation', require('./Pages/Navigation/ParentNavigation.vue').default);
Vue.component('StudentNavigation', require('./Pages/Navigation/StudentNavigation.vue').default);
Vue.component('GuardNavigation', require('./Pages/Navigation/GuardNavigation.vue').default);
Vue.component('SchooladminNavigation', require('./Pages/Navigation/SchooladminNavigation.vue').default);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    vuetify
});
