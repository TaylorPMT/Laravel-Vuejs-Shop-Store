<template>
    <div class="content-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-success" @click="submit()">Lưu lại</button>
                <BaseBackPage :page="`/admin/category`"></BaseBackPage>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <BaseInput
                    :label="'Tên Sản Phẩm'"
                    :class_form="'form-control'"
                    v-model="dataCurrent.name"
                ></BaseInput>
                <BaseInput :label="'URL'" :class_form="'form-control'" v-model="dataCurrent.link"></BaseInput>
                <BaseCkeditor :label="'Mô tả ngắn'" v-model="dataCurrent.description"></BaseCkeditor>
                <BaseCkeditor
                    :label="'Mô tả chi tiết'"
                    :editorData="dataCurrent.content"
                    v-model="dataCurrent.content"
                ></BaseCkeditor>
                   
            </div>
            <div class="col-md-4">
                 <div class="image-preview" v-if="!isEmpty(dataCurrent.image)">
                    <div
                        class="item"
                        v-for="(item,index) in dataCurrent.image"
                        :key="'image-' + index"
                    >
                        <img :src="asset(item)" :alt="'image-' + index" />
                        <div class="delete-image">
                        <span class="material-icons">
                            clear
                        </span>

                    </div>
                    </div>
                    
                </div>
                  <BaseCkfinder
                    ref="ckfinder"
                    id="imagePage"
                    :multiImage="true"
                    @inputCKFinder="getValueImage($event)"
                ></BaseCkfinder>
                <div class="text-right">
                    <button
                    type="button"
                    class="btn btn-sm btn-success"
                    @click="handleFileUpload()"
                    >Tải hình ảnh</button>
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
            content: "",
            dataImage: {
                type: Array,
                default: () => []
            },
        };
    },
    computed: {
        ...mapState({
            dataCurrent: state => state.storeCategory.DETAIL_CATEGORY
        })
    },
    methods: {
        async handleFileUpload() {
            this.$refs.ckfinder.selectFileWithCKFinder('imagePage', 'modal');
        },
        async handleCategoryDetail() {
            let route = this.getPathUrl();
            let res = await this.$store.dispatch("findCategoryByID", [route.id, ""]);
            if (res.error == true) {
                this.error(res.message);
                return this.abort(res.response_code);
            }
            return res;
        },
        async getValueImage(e) {
            let vm = this;
            let arr = e.map((images, i) => {
                let index = images.indexOf("uploads");
                return images.slice(index, images.length);
            });
            for (let property in arr) {
                vm.dataCurrent.image.push(arr[property]);
            }

            return vm.dataCurrent.image;

        },
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
                    "orders",
                    "parent_id",
                    'image'
                )
                ;
            return customer;
        },
        async submit() {
            let show = confirm(this.message().confirm_update);
            if (show) {
                let res = await this.$store.dispatch("updateCategory", {
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
        await this.handleCategoryDetail();
        this.loading = true
    },

    components: {
        Navbar,
        Form
    }
};
</script>
<style lang="scss" scoped>
.image-preview {
    margin-top: 30px;
    width: 100%;
    height: auto;
    position: relative;
    display: flex;
    flex-wrap: wrap;
    .item {
        margin: 10px 5px;
        width: 150px;
        height: 150px;
        position: relative;
        > img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .delete-image {
            position: absolute;
            right: -10px;
            top: -10px;
            z-index: 9;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #f44336;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: .3s all;
            span {
                color: white;
                font-weight: bold;
                font-size: 20px;
            }
        }
        &:hover {
            .delete-image {
                opacity: 1;
                visibility: visible;
                transition: .3s all;
            }
        }
    }
}
.content-group {
    margin: 5% 4%;
}
</style>>
