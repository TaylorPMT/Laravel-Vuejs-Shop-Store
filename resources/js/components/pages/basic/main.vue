<template>
    <div>
        <MenuSidebar></MenuSidebar>
        <Navbar></Navbar>
        <router-view />
    </div>
</template>
<script>
import Fragment from "vue-fragment";
import { mapState } from "vuex";
import MenuSidebar from "../../elements/MenuSidebar";
import Navbar from "../../elements/Navbar";
export default {
    components: {
        Fragment,
        Navbar,
        MenuSidebar
    },
    methods: {
        async getInfo() {
            this.$store.dispatch("getUserById");
        }
    },
    async created() {
        this.getInfo();
    }
};
</script>
