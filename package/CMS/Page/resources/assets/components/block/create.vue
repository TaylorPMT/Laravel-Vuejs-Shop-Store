<template>
    <div class="content-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-success" @click="submit()">
                    Lưu lại
                </button>
                <BaseBackPage :page="`/admin/block/page`"></BaseBackPage>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 2">
                <BaseInput
                    :label="'Tên block'"
                    :class_form="'form-control'"
                    v-model="data.name"
                ></BaseInput>
                <BaseFormSelect
                    v-model="data.folder"
                    :label="'Folder'"
                    :options="ConfigFolderPage"
                />
                <BaseInput
                    :label="'Tiêu đề'"
                    :class_form="'form-control'"
                    v-model="data.json_block.name"
                ></BaseInput>
                <BaseInput
                    :label="'JSON_BLOCK'"
                     :class_form="'form-control'"
                    :editorData="data.json_block.data_content"
                    v-model="data.json_block.data_content"
                ></BaseInput>
            </div>
            <div class="col-md-4">
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
                >
                    Tải hình ảnh
                </button>
                <div class="image-preview" v-if="!isEmpty(data.image)">
                    <div
                        class="item"
                    >
                        <img :src="asset(data.image)" :alt="'image-'" />
                    </div>
                </div>
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
                folder: "",
                image: [],
                json_block: {
                    list_category: [],
                    list_product: [],
                    data_content: "",
                    name: ""
                },
                dataCategory: [],
                optionsCategory: []
            },
            dataImage: {
                type: Array,
                default: () => []
            }
        };
    },
    computed: {
        ...mapState({
            CategoryList: state => state.storeCategory.LIST_CATEGORY,
            ConfigFolderPage: state => state.storeBlock.CONFIG_BLOCK
        })
    },
    methods: {
        async handleFileUpload() {
            this.$refs.ckfinder.selectFileWithCKFinder("imagePage", "modal");
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
            await this.setCategory();
            let customer = vm.readOnlyJson(
                vm.parseJSON(vm.data),
                "name",
                "folder",
                "image",
                "json_block"
            );
            return customer;
        },
        async handleGetAllCategory() {
            let res = await this.$store.dispatch("getListCategory", {});
            let data = this.CategoryList.data;
            let arr = [];
            for (let item in data) {
                let obj = {};
                obj.id = data[item].id;
                obj.text = data[item].name;
                if (data[item] !== "") {
                    arr.push(obj);
                }
            }

            this.optionsCategory = arr;
        },
        async setCategory() {
            let vm = this;
            let dataCategory = this.dataCategory;
            for (let property in dataCategory) {
                if (dataCategory[property] !== "") {
                    let obj = {};
                    obj.id = dataCategory[property];
                    vm.json_block.list_category.push(obj);
                }
            }
        },
        async submit() {
            let show = confirm(this.message().confirm_update);
            if (show) {
                let res = await this.$store.dispatch("createPageBlock", {
                    data: await this.formatData()
                });
                if (res.error == false) {
                    this.success(res.message, "");
                    this.$store.commit("SET_STATUS_ACTION");
                }
            }
        },
        async getConfig() {
            let res = await this.$store.dispatch("getPageBlock", {});
            return true;
        }
    },

    async created() {
        await this.handleGetAllCategory();

        await this.getConfig();
    },
    "DetailConfigPage.folder": async function(val) {
        let block = this.ConfigFolderPage;
        let obj = block.find((o, i) => {
            return o.id == val;
        });
        this.DetailConfigPage.image = obj.image;
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
</style>
