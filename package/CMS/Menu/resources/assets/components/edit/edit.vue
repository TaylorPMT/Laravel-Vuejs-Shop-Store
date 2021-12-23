<template>
    <div class="content-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-success" @click="submit()">Lưu lại</button>
                <BaseBackPage :page="`/admin/menu`"></BaseBackPage>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <BaseInput
                    :label="'Tên Menu'"
                    :class_form="'form-control'"
                    v-model="dataCurrent.name"
                ></BaseInput>
                <!-- <BaseInput :label="'URL'" :class_form="'form-control'" v-model="dataCurrent.link"></BaseInput> -->
                <BaseInput
                    :label="'Đường dẫn Menu'"
                    :class_form="'form-control'"
                    v-model="dataCurrent.link"
                ></BaseInput>

                <BaseInput
                    :label="'Vị trí Menu'"
                    :class_form="'form-control'"
                    v-model="dataCurrent.order"
                ></BaseInput>
                
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import Navbar from "../../../../../../../resources/js/components/elements/Navbar";
import Form from "../../../../../../../resources/js/components/elements/Form";
import mixin from "../../../../../../../resources/js/mix/mixin";
import notice from "../../../../../../../resources/js/mix/notice";

export default {
    mixins: [mixin, notice],
    data() {
        return {
           
           
        };
    },
    computed: {
        ...mapState({
            dataCurrent: state => state.storeMenu.DETAIL_MENU
        })
    },
    methods: {
        async getData() {
            let route = this.getPathUrl();
            let res = await this.$store.dispatch("findMENUByID", [route.id, ""]);
            if (res.error == true) {
                this.error(res.message);
                return this.abort(res.response_code);
            }
            console.log(res)
            console.log(this.dataCurrent)
            return res;
            
        },

    },

    async created() {
        await this.getData();
        this.loading = true
    },

    components: {
        Navbar,
        Form
    }
};
</script>