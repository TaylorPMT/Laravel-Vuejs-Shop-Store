require("./bootstrap");
window.Vue = require("vue");
import router from "./router/index";

import Vuex from "vuex";
import store from "./store";
import global from '../js/components/global/_globals';


Vue.component('search-component', require('./components/pages/components/search.vue').default);

new Vue({
    el: "#frontend",
    store,
    router,
    data() {
   
    },
    methods: {
        
    }
});