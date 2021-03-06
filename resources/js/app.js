/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import DataTable from 'laravel-vue-datatable'
// import DateRangePicker from 'vue2-daterange-picker'
// import Chart from 'chart.js'
// import "vue2-daterange-picker/dist/vue2-daterange-picker.css";
import 'ag-grid-community/dist/styles/ag-grid.css';
import 'ag-grid-community/dist/styles/ag-theme-balham.css';

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
// Vue.use(Chart)
Vue.use(DataTable);
// Vue.use(DateRangePicker);
require('./bootstrap');

window.Vue = require('vue');





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
//players
Vue.component('players-content', require('./backend/players.vue').default);
Vue.component('addplayer-content', require('./backend/addPlayer.vue').default);
//games
Vue.component('games-content', require('./backend/games.vue').default);
Vue.component('editgame-content', require('./backend/editGame.vue').default);
// Vue.component('addgame-content', require('./backend/addGame.vue').default);
//bets
Vue.component('bets-content', require('./backend/bets.vue').default);
Vue.component('barchart-content', require('./backend/barChart.vue').default);
//dailyBets
Vue.component('dailybets-content', require('./backend/dailyBets.vue').default);
//charjs
Vue.component('line-chart', require('./backend/components/Chart.vue').default);
Vue.component('user-ag-content', require('./backend/userAG.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
