<template>
    <div
        :class="[`${isShow}`, 'modal popup-0']"
        tabindex="-1"
        data-backdrop="static"
        data-keyboard="false"
        role="dialog"
    >
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <span class="ti-alert"></span>
                <p :class="[`${key}`, 'title-popup']">
                    {{ text }}
                </p>
                <div class="btnEvent">
                    <button @click="close()" class="btn btn-success btn-sm">
                        Đồng ý
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
    name: "Message",
    data: () => ({
        isShow: "",
        key: "",
        text: ""
    }),
    computed: {
        ...mapState({
            keyPopup: state => state.AllPage.keyPopup,
            textPopup: state => state.AllPage.textPopup
        })
    },
    methods: {
        open() {
            this.isShow = "show";
        },
        close() {
            console.log("ok");
            this.isShow = "fade";
            this.$store.commit("RESET_POPUP");
        }
    },
    watch: {
        keyPopup(val) {
            let vm = this;
            vm.key = val;
            vm.text = vm.textPopup;
            switch (val) {
                case "success":
                    vm.open();
                    break;
                case "error":
                    vm.open();
                    break;
                default:
                    break;
            }
        }
    }
};
</script>
<style scoped>
.show {
    display: block;
}
.title-popup {
    display: block;
    text-align: center;
    margin: 10px;
    font-size: 18px;
}
.success {
    color:green;
    font-weight: 500;
}
.danger {
    color:red;
    font-weight: 500;
}
.btnEvent{
    display: flex;
    justify-content: center;
    margin: 5px;
}
</style>
