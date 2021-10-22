require("./bootstrap");
window.Vue = require("vue");
import router from "./router/index";
import ViewUI from "view-design";
import "view-design/dist/styles/iview.css";
import Vuex from "vuex";
import store from "./store";
Vue.use(router);
Vue.use(ViewUI);
Vue.use(Vuex);
Vue.component("mainapp", require("./components/mainapp.vue").default);
new Vue({
    el: "#app",
    store,
    router
});


import Vue from 'vue';
import CKEditor from 'ckeditor4-vue';

Vue.use( CKEditor );


import global from '../js/components/global/_globals';
