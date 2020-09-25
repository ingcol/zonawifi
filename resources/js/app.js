/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import SimpleVueValidation from 'simple-vue-validator';
Vue.use(SimpleVueValidation);
import 'vue-spinners/dist/vue-spinners.css'
import { SquareSpinner } from 'vue-spinners/dist/vue-spinners.common'

Vue.component('square', SquareSpinner);
import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
import fullscreen from 'vue-fullscreen';
Vue.use(fullscreen);

// Include Dependencies

import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';
import Column2D from 'fusioncharts/fusioncharts.charts';
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion';
import Excel from 'fusioncharts/fusioncharts.excelexport';

Vue.use(VueFusionCharts, FusionCharts, Column2D, FusionTheme,Excel);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('componente', require('./components/ExampleComponent.vue').default);
Vue.component('barrio', require('./components/BarrioComponent.vue').default);
Vue.component('usuario', require('./components/UsuarioComponent.vue').default);
Vue.component('cuenta', require('./components/CuentaComponent.vue').default);
Vue.component('rol', require('./components/RolComponent.vue').default);
Vue.component('empresa', require('./components/EmpresaComponent.vue').default);
Vue.component('home', require('./components/HomeComponent.vue').default);
Vue.component('beneficiario', require('./components/BeneficiarioComponent.vue').default);
Vue.component('informeexcel', require('./components/InformeExcelComponent.vue').default);
Vue.component('beneficiariosinayuda', require('./components/BeneficiarioSinAyudaComponent.vue').default);
Vue.component('informe', require('./components/InformeComponent.vue').default);
Vue.component('grafica-rondon', require('./components/GraficaRondonComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
