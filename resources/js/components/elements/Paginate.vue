<template>
    <!-- Begin pagination -->
    <tr class="content-pagination" v-if="data">
        <ul
            class="pagination pagination-sm m-0"
            :class="className"
            v-if="data.total > data.per_page"
        >
            <li
                class="page-item"
                v-if="data.current_page > 1"
                :class="data.current_page == 1 ? 'none' : ''"
            >
                <a
                    class="page-link page-arrow p-0"
                    href="javascript:void(0)"
                    @click.stop.prevent="value.page = 1"
                >
                    <img
                        src="/images/icons/arrow-double-left.svg"
                        class="img-fluid"
                        alt=""
                    />
                </a>
            </li>
            <li
                class="page-item"
                v-if="data.current_page > 1"
                :class="data.current_page == 1 ? 'none' : ''"
            >
                <a
                    class="page-link page-arrow p-0"
                    href="javascript:void(0)"
                    @click.stop.prevent="value.page -= value.page > 1 ? 1 : 0"
                >
                    <img
                        src="/images/icons/arrow-single-left.svg"
                        class="img-fluid"
                        alt=""
                    />
                </a>
            </li>
            <li
                class="page-item"
                v-if="data.last_page - value.page < 4 && data.last_page > 5"
            >
                <a class="page-link p-0" href="javascript:void(0)">
                    <i class="ionicons ion-android-more-horizontal"></i>
                </a>
            </li>
            <li
                href="javascript:void(0)"
                class="page-item"
                v-for="(item, idx) in pagesNumber"
                :key="idx"
            >
                <a
                    class="page-link page-number p-0"
                    href="javascript:void(0)"
                    @click.stop.prevent="value.page = item"
                    :class="{ active: item == data.current_page }"
                    >{{ item }}</a
                >
            </li>
            <li class="page-item" v-if="data.last_page - value.page > 3">
                <a class="page-link p-0" href="javascript:void(0)">
                    <i class="ionicons ion-android-more-horizontal"></i>
                </a>
            </li>
            <li
                class="page-item"
                :class="data.current_page == data.last_page ? 'none' : ''"
            >
                <a
                    class="page-link page-arrow p-0"
                    href="javascript:void(0)"
                    @click.stop.prevent="
                        value.page += value.page < data.last_page ? 1 : 0
                    "
                >
                    <img
                        src="/images/icons/arrow-single-right.svg"
                        class="img-fluid"
                        alt="icons-arrow-right"
                    />
                </a>
            </li>
            <li
                class="page-item"
                :class="data.current_page == data.last_page ? 'none' : ''"
            >
                <a
                    class="page-link page-arrow p-0"
                    href="javascript:void(0)"
                    @click.stop.prevent="value.page = data.last_page"
                >
                    <img
                        src="/images/icons/arrow-double-right.svg"
                        class="img-fluid"
                        alt=""
                    />
                </a>
            </li>
        </ul>
        <td class="custom-select-option" :class="classNameSelect">
            <select class="custom-select" v-model="value.per_page">
                <option
                    v-for="(row, index) in options"
                    :key="index"
                    :value="row"
                    >{{ row }}</option
                >
            </select>
            <i class="ionicons ion-arrow-down-b"></i>
        </td>
        <td class="show-paginate"
            >Hiển thị <strong>{{ data.from }}-{{ data.to }}</strong> của <strong>{{ data.total }}</strong>
            {{ namePaginate }}</td
        >
    </tr>
    <!-- End pagination -->
</template>

<script>
import { mapState } from "vuex";
export default {
    props: [
        "className",
        "data",
        "namePaginate",
        "classNameSelect",
        "options",
        "value",
        "path",
        "params"
    ],
    data() {
        return {
            offset: 1,
            page: 1,
            pagination: {},
            debounce: null
        };
    },
    created() {
        let vm = this;
        vm.pagination = vm.value;
    },
    computed: {
        pagesNumber() {
            if (!this.data.to) {
                return [];
            }
            let from = this.data.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            let to = from + this.offset * 4;
            if (to >= this.data.last_page) {
                to = this.data.last_page;
            }
            let pagesArray = [];
            if (to > 5 && to - from < 5) {
                for (let page = to - 4; page <= to; page++) {
                    pagesArray.push(page);
                }
            } else {
                for (let page = 1; page <= to; page++) {
                    pagesArray.push(page);
                }
            }

            return pagesArray;
        },
        ...mapState({
            sort: state => state.global.sort
        })
    },
    methods: {
        handleSelectOption(val) {}
    },
    watch: {
        pagination: {
            deep: true,
            handler: async function(newval, oldval) {
                let vm = this;
                if (vm.path && vm.path != "") {
                    let listCheckbox = document.querySelectorAll(".check-one");
                    vm.$parent.listChecked = [];
                    vm.$parent.listSelected = [];
                    for (let i = 0; i < listCheckbox.length; i++) {
                        listCheckbox[i].checked = false;
                        listCheckbox[i]
                            .closest("tr")
                            .classList.remove("hover-cell");
                    }
                    clearTimeout(vm.debounce);
                    if (typeof vm.$parent[vm.path] === "function") {
                        await vm.$parent[vm.path]();
                    } else {
                        vm.debounce = setTimeout(function() {
                            vm.$store.dispatch(vm.path, {
                                key_word:
                                    vm.$parent.query &&
                                    vm.$parent.query.key_word
                                        ? vm.$parent.query.key_word
                                        : "",
                                params: {
                                    order_by: vm.sort.order_by,
                                    sort_by: vm.sort.sort_by,
                                    ...(vm.params != undefined ? vm.params : "")
                                },
                                ...newval
                            });
                        }, 200);
                    }
                }
            }
        },
        "pagination.per_page": {
            deep: true,
            handler: function(newval, oldval) {
                let vm = this;
                if (newval) {
                    vm.pagination.page = 1;
                }
            }
        }
    }
};
</script>
<style lang="css" scoped>
.page-link {
    padding: 0 10px;
    margin: 0 5px;
}
</style>
