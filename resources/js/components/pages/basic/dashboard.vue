<template>
    <div>

        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "></h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="myTable">
                                    <thead class=" text-primary">
                                        <th>#</th>
                                        <th>
                                            Tên Người Dùng
                                        </th>
                                        <th>Email</th>
                                    </thead>
                                    <tbody v-if="listAdminPage">
                                        <tr
                                            v-for="(item,
                                            index) in listAdminPage.data"
                                            :key="index"
                                        >
                                            <td class="td-center">
                                                {{ listAdminPage.from + index }}
                                            </td>
                                            <td>{{ item.name }}</td>
                                            <td>{{ item.email }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <Paginate
                                            :className="''"
                                            v-model="pagination"
                                            :data="listAdminPage"
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
import VDashboard from "../../elements/VDashboard";
import Navbar from "../../elements/Navbar";
import Paginate from "../../elements/Paginate";
export default {
    name: "dashboard",
    computed: {
        ...mapState({
            statusDetail: state => state.AllPage.statusDetail,
            Admin: state => state.User.ADMIN,
            listAdminPage: state => state.User.LIST_USER_ITEMS
        })
    },
    data() {
        return {
            title: "Trang quản lý",
            pagination: {
                page: 1,
                per_page: 20
            },
            options: [20, 30, 50],
            filters: {
                key_word: "",
                order_by: "name",
                sort_by: "desc",
                fields: []
            }
        };
    },
    components: {
        VDashboard,
        Paginate,
        Navbar
    },

    methods: {
        async getListAdmin() {
            let options = {
                ...this.filters,
                fields: this.filters.fields.toString(),
                ...this.pagination
            };
            let res = await this.$store.dispatch("getListUsers", options);
            return res;
        },
        async logout() {
            let res = this.$store.dispatch("logout", "/", "");
            if (res.data.error == null && res.data.response_code == 200) {
                window.location.reload();
            }
        }
    },
    async created() {
        let vm = this;
        if (this.statusDetail === false) {
            this.$store.dispatch("getUserById", "/");
            this.$store.commit("SET_STATUS_DETAIL", true);
        }
        await this.getListAdmin();
    },
    watch: {
        "pagination.page": async function(val) {
            let vm = this;
            if (val) {
                await vm.getListAdmin();
            }
        },
        "pagination.per_page": async function(val) {
            let vm = this;
            if (val) {
                await vm.getListAdmin();
            }
        }
    }
};
</script>
