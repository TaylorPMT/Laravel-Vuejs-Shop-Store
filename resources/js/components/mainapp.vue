<template>
    <router-view />
</template>

<script>

export default {
    data() {
        return {
            status: false,
            body: null
        };
    },
    created() {
        let vm = this;
        if (localStorage.getItem('access_token')) {
            vm.$root.getListSidebar();
            vm.$forceUpdate();
        }
    },
};
</script>

<style>
#app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
}
</style>
