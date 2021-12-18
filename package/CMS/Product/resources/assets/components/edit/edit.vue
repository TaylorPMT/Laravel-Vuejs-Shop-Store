<template>
    <div class="content-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-success" @click="submit()">Lưu lại</button>
                <BaseBackPage :page="`/admin/product`"></BaseBackPage>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <BaseInput
                    :label="'Tên Sản Phẩm'"
                    :class_form="'form-control'"
                    v-model="dataProduct.name"
                ></BaseInput>
                <BaseInput
                    :label="'SKU Sản Phẩm'"
                    :class_form="'form-control'"
                    v-model="dataProduct.sku"
                ></BaseInput>
                <BaseInput :label="'URL'" :class_form="'form-control'" v-model="dataProduct.url"></BaseInput>
                <BaseFormSelect
                    v-model="dataProduct.category_id"
                    :label="'Loại sản phẩm'"
                    :options="CategoryList.data"
                />
                <BaseCkeditor
                    :label="'Mô tả chi tiết'"
                    :editorData="dataProduct.content"
                    v-model="dataProduct.content"
                ></BaseCkeditor>
                <BaseCkeditor
                    :label="'Thông tin'"
                    :editorData="dataProduct.description"
                    v-model="dataProduct.description"
                ></BaseCkeditor>
            </div>
            <div class="col-md-4">
                <BaseReviewImage :dataCurrent="dataProduct"></BaseReviewImage>
                <BaseCkfinder
                    ref="ckfinder"
                    id="imagePage"
                    :multiImage="true"
                    @inputCKFinder="getValueImage($event)"
                ></BaseCkfinder>
                <button
                    type="button"
                    class="btn btn-sm btn-success"
                    @click="handleFileUpload()"
                >Tải hình ảnh</button>
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
            data: {
                name: "",
                content: "",
                description: "",
                link: "",
                image: [],
                category_id: "",
                sku: "",
            },
            dataImage: {
                type: Array,
                default: () => []
            },
        };
    },
    computed: {
        ...mapState({
            dataProduct: state => state.storeProduct.DETAIL_PRODUCT,
            CategoryList: state => state.storeCategory.LIST_CATEGORY

        })
    },
    methods: {
        async handleGetAllCategory() {
            let res = await this.$store.dispatch("getListCategory", {});

        },
        async handleDetail() {
            let route = this.getPathUrl();
            let res = await this.$store.dispatch("findProduct", [route.id, ""]);
            if (res.error == true) {
                this.error(res.message);
                return this.abort(res.response_code);
            }
            return res;
        },
        async handleFileUpload() {
            this.$refs.ckfinder.selectFileWithCKFinder('imagePage', 'modal');
        },
        async getValueImage(e) {
            let vm = this;
            let arr = e.map((images, i) => {
                let index = images.indexOf("uploads");
                return images.slice(index, images.length);
            });
            for (let property in arr) {
                vm.dataProduct.image.push(arr[property]);
            }

            return vm.dataProduct.image;

        },
        async formatData() {
            let vm = this;
            let customer =
                vm.readOnlyJson(
                    vm.parseJSON(vm.dataProduct),
                    "id",
                    "name",
                    "content",
                    "description",
                    "link",
                    "image",
                    "category_id",
                    'image',
                    'sku'
                )
                ;
            return customer;
        },
        async submit() {
            let show = confirm(this.message().confirm_update);
            if (show) {
                let res = await this.$store.dispatch("updateProduct", {
                    data: await this.formatData()
                });
                if (res.error == false) {
                    this.success(res.message, "");
                    this.$store.commit("SET_STATUS_ACTION");
                }
            }
        }

    },

    async created() {
        await this.handleGetAllCategory();
        await this.handleDetail();
    },

    components: {
        Navbar,
        Form
    }
};
</script>

