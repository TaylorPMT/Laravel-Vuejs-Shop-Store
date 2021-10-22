<template>
    <div class="content-group">
        <div class="row">
            <div class="col-md-8">
                <form>
                    <BaseInput :label="'Tên Sản Phẩm'" :class_form="'form-control'"></BaseInput>
                    <!-- <BaseFileManager></BaseFileManager> -->
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
import Navbar from "../../../../../../../resources/js/components/elements/Navbar";
import Form from "../../../../../../../resources/js/components/elements/Form";
export default {
    data() {
        return {
            form: [
                {
                    label: "Tên",
                    type: "text",
                    key: "input",
                    class: "form-control",
                    value: "",
                    placeholder: "Vui lòng nhập tên sản phẩm"
                },
                {
                    label: "Tên",
                    type: "text",
                    key: "textarea",
                    class: "form-control",
                    value: "",
                    placeholder: "Vui lòng nhập tên sản phẩm"
                }
            ]
        };
    },

    components: {
        Navbar,
        Form
    }
};
</script>
<style lang="scss" scoped></style>>
