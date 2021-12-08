import Vue from "vue";
import Router from "vue-router";
Vue.use(Router);
import login from "../components/pages/basic/home.vue";
import dashboard from "../components/pages/basic/dashboard.vue";
import main from "../components/pages/basic/main.vue";
import category from "../../../package/CMS/Category/resources/assets/routes/index";
import product from "../../../package/CMS/Product/resources/assets/routes/index";

import error404 from "../components/error/404.vue";
const routes = [{
        path: "/admin",
        component: main,
        children: [{
            path: "dashboard",
            name: "dashboard",
            component: dashboard
        }, ],
        beforeEnter: (to, from, next) => {
            let access_token = localStorage.getItem("access_token");
            if (to.name !== "login" && !access_token) {
                window.localStorage.removeItem("access_token");
                next({
                    name: "login"
                });
            } else if (to.path === "/admin" && access_token) {
                next({
                    name: "dashboard"
                });
            } else {
                next();
            }
            next();
        }
    },
    {
        path: ''
    },
    {
        path: "/login",
        name: "login",
        component: login,
        beforeEnter: (to, from, next) => {
            let access_token = localStorage.getItem("access_token");
            if (to.name === "login" && access_token) {
                next({
                    name: "dashboard"
                });
            } else {
                next();
            }
        }
    },
    {
        path: "/404",
        name: "404",
        component: error404,
    }
];
routes[0].children = routes[0].children.concat(
    category,
    product
);
export default new Router({
    mode: "history",
    linkActiveClass: "active",
    routes
});
