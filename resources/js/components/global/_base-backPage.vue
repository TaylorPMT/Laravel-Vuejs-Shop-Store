<template>
    <div>
        <span class="btn btn-sm btn-danger" @click="handleBackEvent()">Quay trở về</span>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
    watch: {
        statusAction(value) {
            if (value == true) {
                this.$store.commit("RESET_STATUS_ACTION");
                this.$router.push(this.page);
            }
        }
    },
    props: {
        page: {
            type: String,
            default: "/admin"
        }
    },
    created() { },
    computed: {
        ...mapState({
            statusAction: state => state.AllPage.statusAction,
            actionPopup: state => state.AllPage.actionPopup
        })
    },
    methods: {
        async handleBackEvent() {
            if (this.statusAction == false) {
                await this.$store.commit("SET_SHOW_POPUP", {
                    key: "danger",
                    text: "Chưa lưu dữ liệu , bạn muốn quay lại không ?",
                    action: true
                });
            } else {
                this.$router.push(this.page);
            }
        }
    }
};
</script>
