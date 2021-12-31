<template>
    <div>
        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-2">
                    <div>
                        <router-link
                            :to="
                                encodeURI('/admin/news/category/create')
                            "
                            rel="tooltip"
                            :title="title"
                            class="btn btn-success btn-primary"
                        >
                            <span v-html="title"></span>
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

                                        <th style="width: 40%;">Mô tả ngắn</th>
                                        <th style="text-align: right;">Lựa chọn</th>
                                    </thead>
                                    <tbody v-if="listData">
                                        <tr
                                            v-for="(item,
                                            index) in listData.data"
                                            :key="index"
                                        >
                                            <td class="td-center">{{ listData.from + index }}</td>
                                            <td>{{ item.name }}</td>

                                            <td>
                                                <p v-html="strippedContent(item.description)"></p>
                                            </td>
                                            <td class="td-actions text-right">
                                                <router-link
                                                    :to="
                                                        encodeURI('/admin/news/category/' +
                                                            item.id +
                                                            '/edit')
                                                    "
                                                    rel="tooltip"
                                                    title="Chỉnh sửa"
                                                    class="btn btn-success"
                                                >
                                                    <i class="material-icons">edit</i>
                                                </router-link>
                                                <button
                                                    type="button"
                                                    rel="tooltip"
                                                    title="Xóa loại sản phẩm"
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
                                            namePaginate="Customer"
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
import mixin from "../../../../../../../../resources/js/mix/mixin";
import Navbar from "../../../../../../../../resources/js/components/elements/Navbar";
import Paginate from "../../../../../../../../resources/js/components/elements/Paginate";
import notice from "../../../../../../../../resources/js/mix/notice";

export default {
    mixins: [mixin, notice],
    name: 'Category_news',
    watch: {
        "pagination.page": async function (val) {
            let vm = this;
            if (val) {
                await vm.getList();
            }
        },
        "pagination.per_page": async function (val) {
            let vm = this;
            if (val) {
                await vm.getList();
            }
        }
    },
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
            let res = await this.$store.dispatch('getListNewsCategory', options);

            return res;
        },
        async handleDelete(id) {
            let show = confirm(this.message().confirm_delete);
            if (show) {
                let res = await this.$store.dispatch("deleteCategoryByID", {
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
            listData: state => state.storeNews.LIST_NEWS_CATEGORY
        })
    },
    data() {
        return {
            title: "Thêm danh mục",
            show_download: true,
            downloading: false,
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
