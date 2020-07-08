require('./bootstrap');
import Vue from 'vue';
import { BootstrapVue, IconsPlugin} from "bootstrap-vue";

import CardInfo from './components/CardInfo';
import PaymentType from "./components/PaymentType";
import PaymentForm from "./components/PaymentForm";
import VueCurrencyInput from "vue-currency-input";
import vSelect from 'vue-select';

Vue.component('v-select', vSelect);
Vue.component('card-info', CardInfo);
Vue.component('payment-type', PaymentType);
Vue.component('payment-form', PaymentForm);

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueCurrencyInput, {
    globalOptions: {
        currency: 'AUD', // only override the default currency 'EUR' with 'USD'
        locale: 'en',
        distractionFree: false,
        allowNegative: false
    },
});

const app = new Vue({
    el: '#app',
    data: {
        type: 'CA'
    }
});
