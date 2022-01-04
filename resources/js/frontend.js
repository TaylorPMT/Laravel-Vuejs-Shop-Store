require("./bootstrap");
window.Vue = require("vue");
import Vuex from "vuex";
import global from '../js/components/global/_globals';


Vue.component('search-component', require('./components/pages/components/search.vue').default);

new Vue({
    el: "#frontend",
});