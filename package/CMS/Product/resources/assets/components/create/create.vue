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
                <BaseInput :label="'Tên Sản Phẩm'" :class_form="'form-control'" v-model="data.name"></BaseInput>
                <BaseInput :label="'SKU Sản Phẩm'" :class_form="'form-control'" v-model="data.sku"></BaseInput>
                <!-- <BaseInput :label="'URL'" :class_form="'form-control'" v-model="data.url"></BaseInput> -->
                <BaseFormSelect
                    v-model="data.category_id"
                    :label="'Loại sản phẩm'"
                    :options="CategoryList.data"
                />
                <BaseCkeditor
                    :label="'Mô tả chi tiết'"
                    :editorData="data.content"
                    v-model="data.content"
                ></BaseCkeditor>
                <BaseCkeditor
                    :label="'Thông tin'"
                    :editorData="data.description"
                    v-model="data.description"
                ></BaseCkeditor>
            </div>
            <div class="col-md-4">
                <BaseReviewImage :dataCurrent="data"></BaseReviewImage>
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
        }
    },
    computed: {
        ...mapState({
            CategoryList: state => state.storeCategory.LIST_CATEGORY
        })
    },
    methods: {
        async handleGetAllCategory() {
            let res = await this.$store.dispatch("getListCategory", {});
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
                vm.data.image.push(arr[property]);
            }

            return vm.data.image;

        },
        async formatData() {
            let vm = this;
            let customer =
                vm.readOnlyJson(
                    vm.parseJSON(vm.data),
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
                let res = await this.$store.dispatch("createProduct", {
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
    },

    components: {
        Navbar,
        Form
    }
};
</script>
<style lang="scss" scoped>
.image-preview {
    width: 100%;
    height: 200px;
    position: relative;
    display: flex;
    .item {
        margin: 5px;
        width: 100px;
        height: 100px;
        position: relative;
        > img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    }
}
</style>>
