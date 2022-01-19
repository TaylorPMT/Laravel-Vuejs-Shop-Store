<template>
    <div class="content-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-success" @click="submit()">Lưu lại</button>
                <BaseBackPage :page="`/admin/page`"></BaseBackPage>
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
            let res = await this.$store.dispatch('findPageEdit', [
                route.id, ''
            ]);
            return res;
        },
        async setCategorySelect2() {
            let vm = this;
            let dataCategory = this.BlockPage;

            for (let property in dataCategory) {
                let data = dataCategory[property];
                if (data !== '') {
                    this.dataCategory.push(data.id);
                }
            }

        },
        async submit() {
            let route = this.getPathUrl();
            let show = confirm(this.message().confirm_update);
            if (show) {
                let res = await this.$store.dispatch("updatePageConfig", {
                    data: await this.formatData(),
                    id: route.id,
                });
                if (res.error == false) {
                    this.success(res.message, "");
                    this.$store.commit("SET_STATUS_ACTION");
                }
            }
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
        'dataCategory': async function (val) {
            let vm = this;
            let store = vm.BlockPage;
            let arr = [];
            store.forEach(e => {
                let data = val.some(o => o == e.id);

                if (data == true) {
                    let obj = {};
                    obj.id = e.folder;
                    arr.push(obj);
                }
            });
            vm.data.list_id = [];
            vm.data.list_id.push(...arr);

        },
        'data.list_id': async function (val) {
            await this.findPageBlockArray()
        },
    },
    async created() {
        await this.findData();
        await this.getBlockPage();
        await this.setCategorySelect2();
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
    position: relative;
    transition: 0.1s ease-in-out;
    font-size: 16px;
    padding: 24px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 25px rgb(0 0 0 / 5%);
    &::-webkit-scrollbar {
        width: 5px;
        height: 8px;
        background-color: #aaa; /* or add it to the track */
    }
    width: 100%;
    display: flex;
    height: 500px;
    overflow-y: scroll;
    justify-content: center;
    flex-flow: column;
    .image-review {
        min-width: 100%;
        height: auto;
        & > img {
            display: block;
            margin: auto;
            object-fit: cover;
            width: 100%;
        }
    }
}
</style>
