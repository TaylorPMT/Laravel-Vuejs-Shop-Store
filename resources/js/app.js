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
import Select2 from 'v-select2-component';
import Select2MultipleControl from 'v-select2-multiple-component';
import Sortable from 'sortablejs'

Vue.component('Select2', Select2);
Vue.component('Select2MultipleControl', Select2);

Vue.use(router);
Vue.use(CKEditor);
Vue.use(ViewUI);
Vue.use(Vuex);
Vue.use(Notifications)
Vue.component("mainapp", require("./components/mainapp.vue").default);
Vue.component('search-component', require('./components/pages/components/search.vue').default);

window.eventBus = new Vue({});

Vue.directive('sortable', {
    inserted: function(el, binding) {
        new Sortable(el, binding.value || {})
    }
})
new Vue({
    el: "#app",
    store,
    router,
    data() {
        return {
            list_menu: []
        }
    },
    methods: {
        async getListSidebar() {
            let vm = this;
            this.list_menu = await vm.$store.dispatch("getSidebarMenu", {
                params: {
                    config: "sidebar"
                }
            });
        }
    }
});