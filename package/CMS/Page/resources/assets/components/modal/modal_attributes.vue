<template>
    <div :class="[`${isShow} modal popup-0`]" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="close()"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <BaseFormSelect2
                                :nameLabel="title"
                                :status="true"
                                :options="optionsData"
                                v-model="dataSelected"
                            />
                            <BaseInput
                                v-if="!isEmpty(dataSelected)"
                                :label="'Số lượng hiển thị'"
                                :class_form="'form-control'"
                                v-model="quantityPost"
                            ></BaseInput>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="submit()">
                        Đồng ý
                    </button>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                        @click="close()"
                    >
                        Thoát
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import mixin from "../../../../../../../resources/js/mix/mixin";
import notice from "../../../../../../../resources/js/mix/notice";
import { mapState } from "vuex";
export default {
    mixins: [mixin, notice],
    name: "ModalAttribute",
    props: {
        title: {
            type: String,
            default: "Danh sách dữ liệu"
        },
        data: {
            type: [Array, Object],
            default: function() {
                return [];
            }
        }
    },
    data: () => ({
        optionsData: [],
        dataSelected: [],
        isShow: "",
        key: "",
        text: "",
        action: false,
        quantityPost: ""
    }),
    methods: {
        close() {
            this.isShow = "";
        },
        async open() {
            this.optionsData = this.data;
            this.isShow = "show";
        },
        async submit(){
           if(this.isEmpty(this.dataSelected) || this.isEmpty(this.quantityPost)){
               return this.error("Vui lòng chọn dữ liệu", "");
           }

            let str = `[category-item sku="${this.dataSelected.toString()}" quantity="${this.quantityPost}"]`;
            this.$emit('inputData',str);
            this.close();
            return str;
       }
    },
    watch: {},
    async created() {}
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
