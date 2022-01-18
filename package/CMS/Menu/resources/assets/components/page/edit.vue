<template>
    <div class="content-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-success" @click="submit()">Lưu lại</button>
                <BaseBackPage :page="`/admin/menu`"></BaseBackPage>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <BaseInput
                    :label="'Tên Trang'"
                    :class_form="'form-control'"
                    v-model="ConfigPage.name"
                ></BaseInput>
                <BaseFormSelect2
                    :nameLabel="'Chọn cấu trúc page'"
                    :status="true"
                    :options="this.optionsCategory"
                    v-model="dataCategory"
                />
            </div>
            <div class="col-md-8">
                <div class="box-review" v-if="BlockReview">
                    <div class="image-review" v-for="(item, index) in BlockReview" :key="index">
                        <img :src="item.image" />
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
            optionsCategory: [],
            dataCategory: [],
            data: {
                list_id: [],
            },
        };
    },
    computed: {
        ...mapState({
            ConfigPage: state => state.storeMenu.DETAIL_CONFIG_PAGE,
            BlockPage: state => state.storeBlock.LIST_BLOCK_ALL,
            BlockReview: state => state.storeBlock.DETAIL_CONFIG_BLOCK,
        })
    },
    methods: {
        async findData() {
            let route = this.getPathUrl();
            let res = this.$store.dispatch('findPageEdit', [
                route.id, ''
            ]);
            return res;
        },
        async getBlockPage() {
            let res = await this.$store.dispatch('listAllPageBlock', {

            });
            let data = this.BlockPage;
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
            return res;
        },
        async formatData() {
            let vm = this;
            let customer =
                vm.readOnlyJson(
                    vm.parseJSON(vm.data),
                    'list_id'
                )
                ;
            return customer;
        },
        async findPageBlockArray() {
            let res = await this.$store.dispatch('findPageBlockArray', ["", {
                params: await this.formatData()
            }]);
            return res;
        }


    },

    watch: {
        'optionsCategory': async function (val) {
            let vm = this;
            let store = vm.BlockPage;
            let arr = [];
            store.forEach(e => {
                let data = val.some(o => o.id === e.id);
                if (data == true) {
                    let obj = {};
                    obj.id = e.folder;
                    arr.push(obj);
                }
            });
            vm.data.list_id.push(...arr);

        },
        'data.list_id': async function (val) {
            if (!this.isEmpty(val)) {
                await this.findPageBlockArray()
            }
        },
    },
    async created() {
        await this.findData();
        await this.getBlockPage();
        this.loading = true
    },

    components: {
        Navbar,
        Form
    }
};
</script>
<style lang="scss" scope>
.box-review {
    width: 100%;
    display: flex;
    height: 100%;
    justify-content: center;
    flex-flow: column;
    .image-review {
        min-width: 100%;
        height: auto;
        & > img {
            object-fit: cover;
        }
    }
}
</style>
