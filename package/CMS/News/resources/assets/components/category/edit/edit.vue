<template>
    <div class="content-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-success" @click="submit()">Lưu lại</button>
                <BaseBackPage :page="`/admin/news/category`"></BaseBackPage>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <BaseInput
                    :label="'Tên danh mục'"
                    :class_form="'form-control'"
                    v-model="dataCurrent.name"
                ></BaseInput>
                <BaseInput :label="'URL'" :class_form="'form-control'" v-model="dataCurrent.link"></BaseInput>
                <BaseCkeditor
                    :label="'Mô tả ngắn'"
                    :editorData="dataCurrent.description"
                    v-model="dataCurrent.description"
                ></BaseCkeditor>

                <BaseCkeditor
                    :label="'Mô tả chi tiết'"
                    :editorData="dataCurrent.content"
                    v-model="dataCurrent.content"
                ></BaseCkeditor>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
import Navbar from "../../../../../../../../resources/js/components/elements/Navbar";
import Form from "../../../../../../../../resources/js/components/elements/Form";
import mixin from "../../../../../../../../resources/js/mix/mixin";
import notice from "../../../../../../../../resources/js/mix/notice";

export default {
    mixins: [mixin, notice],
    data() {
        return {
            data: {
                name: "",
                content: "",
                description: "",
                link: "",
            },
        };
    },
    computed: {
        ...mapState({
            dataCurrent: state => state.storeNews.DETAIL_NEWS_CATEGORY,
        })
    },
    methods: {
        async formatData() {
            let vm = this;
            let customer =
                vm.readOnlyJson(
                    vm.parseJSON(vm.dataCurrent),
                    "id",
                    "content",
                    "description",
                    "link",
                    "name",
                );

            return customer;
        },
        async submit() {
            let show = confirm(this.message().confirm_update);
            if (show) {
                let res = await this.$store.dispatch("updateNewsCategory", {
                    data: await this.formatData()
                });
                if (res.error == false) {
                    this.success(res.message, "");
                    this.$store.commit("SET_STATUS_ACTION");
                }
            }
        },
        async find() {
            let route = this.getPathUrl();
            let res = this.$store.dispatch('findNewsCategory', [route.id, ""]);
            return res;
        }
    },

    async created() {
        await this.find();
    },

    components: {
        Navbar,
        Form
    }
};
</script>

