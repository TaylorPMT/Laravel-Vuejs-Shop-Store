<template>
    <div>
        <MenuSidebar></MenuSidebar>
        <Navbar></Navbar>
        <router-view />
        <Message></Message>
    </div>
</template>
<script>
import Fragment from "vue-fragment";
import Message from "../../modal/message";
import { mapState } from "vuex";
import MenuSidebar from "../../elements/MenuSidebar";
import Navbar from "../../elements/Navbar";
export default {
    components: {
        Fragment,
        Navbar,
        MenuSidebar,
        Message
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
