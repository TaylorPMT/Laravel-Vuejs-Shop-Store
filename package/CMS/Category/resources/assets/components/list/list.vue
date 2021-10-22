<template>
    <div>
        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title"></h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="myTable">
                                    <thead class="text-primary">
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Hình</th>
                                        <th>Mô tả ngắn</th>
                                    </thead>
                                    <tbody v-if="listData">
                                        <tr
                                            v-for="(item,
                                            index) in listData.data"
                                            :key="index"
                                        >
                                            <td class="td-center">
                                                {{ listData.from + index }}
                                            </td>
                                            <td>{{ item.name }}</td>
                                            <td class="box-image">
                                                <img
                                                    v-bind:src="
                                                        imageUrl(item.image)
                                                    "
                                                />
                                            </td>
                                            <td>{{ item.description }}</td>
                                            <td class="td-actions text-right">
                                                <router-link
                                                    :to="
                                                        encodeURI('/admin/category/' +
                                                            item.id +
                                                            '/edit')
                                                    "
                                                    rel="tooltip"
                                                    title="Chỉnh sửa"
                                                    class="btn btn-success"

                                                >
                                                     <i class="material-icons"
                                                        >edit</i
                                                    >
                                                </router-link>
                                                <button
                                                    type="button"
                                                    rel="tooltip"
                                                    class="btn btn-danger"
                                                >
                                                    <i class="material-icons"
                                                        >close</i
                                                    >
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
import mixin from "../../../../../../../resources/js/mix/mixin";
import Navbar from "../../../../../../../resources/js/components/elements/Navbar";
import Paginate from "../../../../../../../resources/js/components/elements/Paginate";

export default {
    mixins: [mixin],
    methods: {
        async getList() {
            let options = {
                ...this.filters,
                fields: this.filters.toString(),
                ...this.pagination
            };
            let res = await this.$store.dispatch("getListCategory", options);
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
            listData: state => state.storeCategory.LIST_CATEGORY
        })
    },
    data() {
        return {
            title: "Quản lý loại sản phẩm",
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
<style scoped>
.box-image > img {
    width: 100px;
    height: 100px;
}
</style>
