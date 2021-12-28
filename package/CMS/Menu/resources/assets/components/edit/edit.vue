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
                <BaseFormSelect2
                    :nameLabel="'Vui lòng chọn Menu Con'"
                    :status="true"
                    :options="this.optionsCategory"
                    v-model="dataCategory"
                />
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

        };
    },
    computed: {
        ...mapState({
            dataCurrent: state => state.storeMenu.DETAIL_MENU,
            CategoryList: state => state.storeCategory.LIST_CATEGORY
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
            return res;
        },
        async getCategorySelect2() {
            let vm = this;
            let dataCategory = this.dataCurrent.category_id;
            for (let property in dataCategory) {
                let data = dataCategory[property];
                if (data !== '') {
                    this.dataCategory.push(data.id);
                }
            }
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

        async setCategory() {
            let vm = this;
            let dataCategory = this.dataCategory;
            for (let property in dataCategory) {
                if (dataCategory[property] !== '') {
                    let obj = {};
                    obj.id = dataCategory[property];
                    vm.dataCurrent.category_id.push(obj);
                }
            }
        },

        async formatData() {
            let vm = this;
            await this.setCategory();
            let data =
                vm.readOnlyJson(
                    vm.parseJSON(vm.dataCurrent),
                    "id",
                    "name",
                    "link",
                    "parent_id",
                    "category_id",
                    "order",
                )
                ;
            return data;
        },

        async submit() {
            let show = confirm(this.message().confirm_update);
            if (show) {
                let res = await this.$store.dispatch("updateMENU", {
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
        await this.getData();
        await this.handleGetAllCategory();
        await this.getCategorySelect2();
        this.loading = true
    },

    components: {
        Navbar,
        Form
    }
};
</script>
