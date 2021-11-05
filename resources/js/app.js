require("./bootstrap");
window.Vue = require("vue");
import router from "./router/index";
import ViewUI from "view-design";
import "view-design/dist/styles/iview.css";
import Vuex from "vuex";
import store from "./store";
import global from '../js/components/global/_globals';
import CKEditor from 'ckeditor4-vue';
import Notifications from 'vue-notification'

Vue.use(router);
Vue.use(CKEditor);
Vue.use(ViewUI);
Vue.use(Vuex);
Vue.use(Notifications)

Vue.component("mainapp", require("./components/mainapp.vue").default);
new Vue({
    el: "#app",
    store,
    router
});