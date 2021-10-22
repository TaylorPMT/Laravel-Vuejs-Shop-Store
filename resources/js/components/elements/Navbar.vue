<template>
    <nav
        class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top "
    >
        <div class="container-fluid">
            <VDashboard :title="title"></VDashboard>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                aria-controls="navigation-index"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link"
                            href="javascript:;"
                            id="navbarDropdownProfile"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="material-icons">person</i>
                            <p class="d-lg-none d-md-block">
                                Account
                            </p>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="navbarDropdownProfile"
                        >
                            <a class="dropdown-item">
                                Demo
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" @click="logout()"
                                >Đăng Xuất</a
                            >
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
import { mapState } from "vuex";
import VDashboard from "./VDashboard";
export default {
    name: "Navbar",
    data() {
        return {
            name:'',
        }
    },
    components: {
        VDashboard
    },
    props: {
        title: ""
    },
    computed: {
        ...mapState({
            Admin: state => state.User.ADMIN
        })
    },
    methods: {
        async info(){
            return this.name = 'demo';
        },
        async logout() {
            let res = await this.$store.dispatch("logout");
            if (res) {
                window.localStorage.removeItem("access_token");
                this.$router.push("/login");
            }
        }
    },
    async created() {
        this.info();
    }
};
</script>
<style>
nav{
   margin-bottom: 70px;
}
</style>
