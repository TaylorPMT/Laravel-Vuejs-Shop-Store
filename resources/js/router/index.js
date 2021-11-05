import Vue from "vue";
import Router from "vue-router";
Vue.use(Router);
import login from "../components/pages/basic/home.vue";
import dashboard from "../components/pages/basic/dashboard.vue";
import main from "../components/pages/basic/main.vue";
import film from "../components/pages/basic/film.vue";
import category from "../../../package/CMS/Category/resources/assets/routes/index";
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
            } else  {
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
    }
];
routes[0].children = routes[0].children.concat(
    category
);
export default new Router({
    mode: "history",
    linkActiveClass: "active",
    routes
});
