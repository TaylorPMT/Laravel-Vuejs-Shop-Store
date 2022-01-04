window.Vue = require("vue");
import router from "./router/index";
import Vuex from "vuex";
import store from "./store";
Vue.use(router);
Vue.use(Vuex);
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