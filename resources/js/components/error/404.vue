<template>
    <div>404 not found</div>
</template>
<script>
import { mapState } from "vuex";
export default {
    computed: {
        ...mapState({
            ERROR: state => state.AllPage.ERROR_404
        })
    },
    watch: {
        ERROR_404(value) {

        }
    }
}
</script>
