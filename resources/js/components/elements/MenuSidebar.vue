<template>
    <div
        class="sidebar"
        data-color="purple"
        data-background-color="white"
        data-image="/assets/img/sidebar-1.jpg"
    >
        <div class="logo">
            <a class="simple-text logo-normal">
                <img class="img-logo" :src="asset('/frontend/assets/img/logo-main.jpg')" />
                Quản lý SHOP
            </a>
        </div>
        <div class="sidebar-wrapper" v-if="this.$root.list_menu">
            <ul class="nav">
                <li
                    class="nav-item"
                    v-for="(item, index) in this.$root.list_menu"
                    :key="index"
                    :class="{
                        active: subIsActive(item.url)
                    }"
                >
                    <router-link :to="item.url" class="nav-link" exact-active-class="exact-active">
                        <i class="material-icons">{{ item.icon }}</i>
                        <p>{{ item.name }}</p>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import mixin from "../../mix/mixin";
export default {
    mixins: [mixin],
    name: "MenuSidebar",
    computed: {

    },
    methods: {
        subIsActive(input) {
            const paths = Array.isArray(input) ? input : [input];
            return paths.some(path => {
                return this.$route.path.indexOf(path) === 0;
            });
        },
    },
};
</script>
<style lang="sass" scoped>

.logo
    img
        width: 140px
        margin: 0 auto 10px
        display: block
</style>
