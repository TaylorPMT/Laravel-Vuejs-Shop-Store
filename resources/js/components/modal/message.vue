<template>
    <div
        :class="[`${isShow} modal popup-0`]"
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
                    <template v-if="action == true">
                        <button
                            @click="confirm()"
                            class="btn btn-success btn-sm"
                        >
                            Đồng ý
                        </button>
                        <button @click="close()" class="btn btn-danger btn-sm">
                            Thoát
                        </button>
                    </template>
                    <template v-else>
                        <button @click="close()" class="btn btn-success btn-sm">
                            Đồng ý
                        </button>
                    </template>
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
        text: "",
        action: false
    }),
    computed: {
        ...mapState({
            keyPopup: state => state.AllPage.keyPopup,
            textPopup: state => state.AllPage.textPopup,
            confirmPopup: state => state.AllPage.confirmPopup
        })
    },
    methods: {
        async open() {
            this.isShow = "show";
        },
        async confirm() {
            this.$store.commit("SET_STATUS_ACTION");
            this.$store.commit("RESET_POPUP");
        },
        async close() {
            this.isShow = "none";
            this.$store.commit("RESET_POPUP", {
                action: false
            });
        }
    },
    watch: {
        keyPopup(val) {
            let vm = this;
            vm.key = val;
            vm.text = vm.textPopup;
            vm.action = vm.confirmPopup;
            switch (val) {
                case "success":
                    vm.open();
                    break;
                case "danger":
                    vm.open();
                    break;
                default:
                    vm.close();
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
.none {
    display: none;
}
.title-popup {
    display: block;
    text-align: center;
    margin: 10px;
    font-size: 18px;
}
.success {
    color: green;
    font-weight: 500;
}
.danger {
    color: red;
    font-weight: 500;
}
.btnEvent {
    display: flex;
    justify-content: center;
    margin: 5px;
}
</style>
