import Vue from "vue";
import Vuex from "vuex";
import VueRouter from "vue-router";
import CmsStore from "./module/store";
import CategoryStore from "../../package/CMS/Category/resources/assets/modules/store";
import storeProduct from "../../package/CMS/Product/resources/assets/modules/store";
import storeMenu from "../../package/CMS/Menu/resources/assets/modules/store";

Vue.use(Vuex);
Vue.use(VueRouter);

let modules = Object.assign(CmsStore, CategoryStore, storeProduct, storeMenu);

export default new Vuex.Store({
    modules
});
