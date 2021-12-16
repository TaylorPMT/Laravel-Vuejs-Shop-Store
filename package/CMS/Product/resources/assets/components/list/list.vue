<template>
    <div>
        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-2">
                    <div>
                        <router-link
                            :to="
                                encodeURI('/admin/product/create')
                            "
                            rel="tooltip"
                            :title="title"
                            class="btn btn-success btn-primary"
                        >
                            <span>Thêm {{ title }}</span>
                            <span class="material-icons">add</span>
                        </router-link>
                    </div>
                </div>
                <div class="col-md-10 form-search-admin">
                    <form @submit.prevent="handleSearchInput()">
                        <input
                            type="text"
                            v-model="filters.key_word"
                            class="form-group"
                            placeholder="Tìm kiếm..."
                        />
                        <button type="submit" class="btn btn-primary">
                            <em class="material-icons">search</em>
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body no-padding">
                            <div class="table-responsive">
                                <table class="table" id="myTable">
                                    <thead class="text-primary">
                                        <th style="width: 10%;">
                                            <span>STT</span>
                                            <a
                                                href="javascript:void(0)"
                                                class="sortBtn"
                                                title="Sắp xếp"
                                            >
                                                <em class="material-icons">arrow_upward</em>
                                            </a>
                                        </th>
                                        <th>
                                            <span>Tên</span>
                                            <a
                                                href="javascript:void(0)"
                                                class="sortBtn"
                                                title="Sắp xếp"
                                            >
                                                <em class="material-icons">arrow_upward</em>
                                            </a>
                                        </th>
                                        <th>SKU</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Hình</th>
                                        <th>Mô tả ngắn</th>
                                        <th style="text-align: right;">Lựa chọn</th>
                                    </thead>
                                    <tbody v-if="listData">
                                        <tr
                                            v-for="(item,
                                            index) in listData.data"
                                            :key="index"
                                        >
                                            <td class="td-center">{{ listData.from + index }}</td>
                                            <td>
                                                <span v-if="item.name">{{ item.name }}</span>
                                            </td>
                                            <td>
                                                <span v-if="item.sku">{{ item.sku }}</span>
                                            </td>
                                            <td>
                                                <span v-if="item.category">{{ item.category.name }}</span>
                                            </td>
                                            <td class="box-image">
                                                <div
                                                    class="image-preview"
                                                    v-if="!isEmpty(item.image)"
                                                >
                                                    <div
                                                        class="item"
                                                        v-for="(item,index) in item.image"
                                                        :key="'image-' + index"
                                                    >
                                                        <img
                                                            :src="asset(item)"
                                                            :alt="'image-' + index"
                                                        />
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ item.description }}</td>
                                            <td class="td-actions text-right">
                                                <router-link
                                                    :to="
                                                        encodeURI('/admin/product/' +
                                                            item.id +
                                                            '/edit')
                                                    "
                                                    rel="tooltip"
                                                    :title="'Chỉnh sửa ' + title"
                                                    class="btn btn-success"
                                                >
                                                    <i class="material-icons">edit</i>
                                                </router-link>
                                                <button
                                                    type="button"
                                                    rel="tooltip"
                                                    :title="'Xóa' + title"
                                                    class="btn btn-danger"
                                                    @click="handleDelete(item.id)"
                                                >
                                                    <i class="material-icons">close</i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <Paginate
                                            :className="''"
                                            v-model="pagination"
                                            :data="listData"
                                            :namePaginate="title"
                                            :classNameSelect="''"
                                            :options="options"
                                        ></Paginate>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
import mixin from "../../../../../../../resources/js/mix/mixin";
import Navbar from "../../../../../../../resources/js/components/elements/Navbar";
import Paginate from "../../../../../../../resources/js/components/elements/Paginate";
import notice from "../../../../../../../resources/js/mix/notice";

export default {
    mixins: [mixin, notice],
    methods: {
        async handleSearchInput() {
            this.pagination.page = 1;
            await this.getList();
        },
        async getList() {
            let options = {
                ...this.filters,
                fields: this.filters.toString(),
                ...this.pagination
            };
            let res = await this.$store.dispatch("getListProduct", options);
        },
        async handleDelete(id) {
            let show = confirm(this.message().confirm_delete);
            if (show) {

                let res = await this.$store.dispatch("deleteProduct", {
                    id: id
                });
                if (res.error == false) {
                    await this.success(res.message, "");
                    await this.getList();
                }
            }
        }
    },
    async created() {
        await this.getList();
    },
    components: {
        Navbar,
        Paginate
    },
    computed: {
        ...mapState({
            listData: state => state.storeProduct.LIST_PRODUCT
        })
    },
    data() {
        return {
            title: " Sản phẩm",
            pagination: {
                page: 1,
                per_page: 20
            },
            options: [20, 30, 50],
            filters: {
                key_word: "",
                order_by: "created_at",
                sort_by: "desc",
                fields: []
            }
        };
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
        width: 130px;
        height: 130px;
        position: relative;
        > img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }
}
</style>
