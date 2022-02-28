<template>
    <div class="content-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-success" @click="submit()">Lưu lại</button>
                <BaseBackPage :page="`/admin/block/page`"></BaseBackPage>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 2">
                <BaseInput
                    :label="'Tên block'"
                    :class_form="'form-control'"
                    v-model="DetailConfigPage.name"
                ></BaseInput>
                <BaseFormSelect
                    v-model="DetailConfigPage.folder"
                    :label="'Folder'"
                    :options="ConfigFolderPage"
                />
                <BaseInput
                    v-if="DetailConfigPage.json_block"
                    :label="'Tiêu đề'"
                    :class_form="'form-control'"
                    v-model="DetailConfigPage.json_block.name"
                ></BaseInput>
                <BaseCkeditor
                    :label="'JSON_BLOCK'"
                    :editorData="DetailConfigPage.json_block.data_content"
                    v-model="DetailConfigPage.json_block.data_content"
                    v-if="DetailConfigPage.json_block"
                ></BaseCkeditor>
            </div>
            <div class="col-md-4">
                <BaseCkfinder
                    ref="ckfinder"
                    id="imagePage"
                    :multiImage="true"
                    @inputCKFinder="getValueImage($event)"
                ></BaseCkfinder>
                <div class="image-preview" v-if="!isEmpty(DetailConfigPage.image)">
                    <div
                        class="item"
                        v-for="(item,index) in DetailConfigPage.image"
                        :key="'image-' + index"
                    >
                        <img :src="asset(item)" :alt="'image-' + index" />
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
                    data_content: '',
                    name: '',
                },
                dataCategory: [],
                optionsCategory: [],

            },
            dataImage: {
                type: Array,
                default: () => []
            },
        };
    },
    computed: {
        ...mapState({
            CategoryList: state => state.storeCategory.LIST_CATEGORY,
            ConfigFolderPage: state => state.storeBlock.CONFIG_BLOCK,
            DetailConfigPage: state => state.storeBlock.DETAIL_CONFIG_BLOCK
        })
    },
    methods: {
        async findDetail() {
            let route = this.getPathUrl();
            let res = await this.$store.dispatch('findPageBlock', [route.id, ""]);

            return res;
        },
        async handleFileUpload() {
            this.$refs.ckfinder.selectFileWithCKFinder('imagePage', 'modal');
        },

        async formatData() {
            let vm = this;
            let customer =
                vm.readOnlyJson(
                    vm.parseJSON(vm.DetailConfigPage),
                    "id",
                    "name",
                    "folder",
                    "image",
                    "json_block",
                )
                ;
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
                if (data[item] !== '') {
                    arr.push(obj);
                }
            }

            this.optionsCategory = arr;
        },

        async submit() {
            let show = confirm(this.message().confirm_update);
            if (show) {
                let res = await this.$store.dispatch("updatePageBlock", {
                    data: await this.formatData()
                });
                if (res.error == false) {
                    this.success(res.message, "");
                    this.$store.commit("SET_STATUS_ACTION");
                }
            }
        },
        async getConfig() {
            let res = await this.$store.dispatch('getPageBlock', {});
            return true;
        },

    },

    async created() {
        await this.getConfig();
        await this.handleGetAllCategory();
        await this.findDetail();


    },
    watch :{
        'DetailConfigPage.folder': async function (val){
            let block = this.ConfigFolderPage;
            let obj = block.find((o, i) => {
              return o.id == val;
            });
            this.DetailConfigPage.image.push(obj.image);
        },
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
