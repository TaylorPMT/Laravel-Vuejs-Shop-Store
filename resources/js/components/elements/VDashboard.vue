<template>
    <div class="navbar-wrapper">
        <a class="navbar-brand" href="javascript:;">{{ title }}</a>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
    name: "VDashboard",
    props: {
        title: ""
    }
};
</script>
