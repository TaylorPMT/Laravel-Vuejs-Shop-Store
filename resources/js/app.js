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
import App from './components/mainapp.vue';
Vue.use(router);
Vue.use(CKEditor);
Vue.use(ViewUI);
Vue.use(Vuex);
Vue.use(Notifications)
Vue.component("mainapp", require("./components/mainapp.vue").default);
window.eventBus = new Vue({});

new Vue({
    el: "#app",
    store,
    router,

    data() {
        return {

        };
    },
    methods: {
        async getListSidebar() {
            let vm = this;
            await vm.$store.dispatch("getSidebarMenu", {
                params: {
                    config: "sidebar"
                }
            });
        },
    }
});