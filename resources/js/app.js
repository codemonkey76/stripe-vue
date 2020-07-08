require('./bootstrap');
import Vue from 'vue';
import { BootstrapVue, IconsPlugin} from "bootstrap-vue";

import CardInfo from './components/CardInfo';
import PaymentType from "./components/PaymentType";
import PaymentForm from "./components/PaymentForm";

Vue.component('card-info', CardInfo);
Vue.component('payment-type', PaymentType);
Vue.component('payment-form', PaymentForm);

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

const app = new Vue({
    el: '#app',
    data: {
        type: 'CA'
    }
});
