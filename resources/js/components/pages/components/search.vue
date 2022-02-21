<template>
    <div class="wrap-search">
        <div class="searchbox">
            <input placeholder="Tìm Kiếm" v-model="filters.key_word" />
            <button class="btn-search" @click="search">
                <em class="material-icons">search</em>
            </button>

            <div class="wrap-search-result" v-if="!isEmpty(data)">
                <ul>
                    <li v-for="(item, index) in data" :key="index">
                        <div class="item">
                            <a class="wrap-img" :href="item.view_link">
                                <img :src="asset(item.image)" :alt="'image-' + index" />
                            </a>
                            <a :href="item.view_link" class="wrap-title">{{ item.name }}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import mixin from "../../../mix/mixin";
import { callAxios } from "../../../axios/callAxios";
import { mapState } from "vuex";
let axios = new callAxios();

export default {
    mixins: [mixin],
    name: 'search_page',
    data() {
        return {
            keyword: null,
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
            },
            data: [],
        }
    },
    watch: {
        "filters.key_word": async function (val) {
            let vm = this;
            if (val) {
                await vm.getResults();
            }
        }
    },
    methods: {
        async format() {
            return {
                ...this.filters,
                fields: this.filters.fields.toString(),
                ...this.pagination
            };

        },
        async search() {
            window.location = '/search/attribute?key_word=' + this.filters.key_word;
        },
        async getResults() {
            let options = await this.format();
            let res = await axios.getList('/api/site-search?', options);
            if (res.data.data) {
                return this.data = res.data.data;
            }
            this.data = [];
        },
    }
};
</script>
