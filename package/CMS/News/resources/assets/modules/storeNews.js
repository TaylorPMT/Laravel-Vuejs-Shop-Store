import { callAxios } from "../../../../../../resources/js/axios/callAxios";
import callApi from '../../../../../../resources/js/api/callApi';
let axios = new callAxios();

const state = {
    LIST_NEWS_CATEGORY: [],
    DETAIL_NEWS_CATEGORY: [],
    LIST_NEWS_DETAIL: [],
    DETAIL_NEWS: [],
};
const mutations = {
    SET_LIST_NEWS_CATEGORY(state, data) {
        state.LIST_NEWS_CATEGORY = data.data;
    },
    SET_DETAIL_NEWS_CATEGORY(state, data) {
        state.DETAIL_NEWS_CATEGORY = data.data;
    },
    SET_LIST_NEWS_DETAIL(state, data) {
        state.LIST_NEWS_DETAIL = data.data;
    },
    SET_DETTAIL_NEWS(state, data) {
        state.DETAIL_NEWS = data.data;
    }
};
const actions = {
    async getNewsListDetail({ state, dispatch }, options) {
        let res = await axios.getList(callApi.NEW_DETAIL.LIST, options);
        this.commit("SET_LIST_NEWS_DETAIL", {
            data: res.data.data
        });
        return true;
    },

    async getListNewsCategory({ state, dispatch }, options) {
        let res = await axios.getList(callApi.NEWS_CATEGORY.LIST, options);
        this.commit("SET_LIST_NEWS_CATEGORY", {
            data: res.data.data
        });
        return true;
    },
    async createNewsCategory({ state, dispatch }, options) {
        let res = await axios.create(callApi.NEWS_CATEGORY.CREATE, options);
        return res.data;
    },
    async findNewsCategory({ state, dispatch }, [id, options]) {
        let res = await axios.getById(callApi.NEWS_CATEGORY.SHOW, id, options);
        this.commit("SET_DETAIL_NEWS_CATEGORY", {
            data: res.data.data
        });
        return true;
    },
    async deleteNewsCategoryByID({ state, dispatch }, options) {
        let url = `${callApi.NEWS_CATEGORY.DELETE}/`;
        let res = await axios.delete(url, options.id, "");
        return res.data;

    },
    async deleteNewsDetailByID({ state, dispatch }, options) {
        let url = `${callApi.NEW_DETAIL.DELETE}/`;
        let res = await axios.delete(url, options.id, "");
        return res.data;

    },
    async updateNewsCategory({ state, dispatch }, options) {
        let url = `${callApi.NEWS_CATEGORY.EDIT}${options.data.id}`;
        let res = await axios.edit(url, '', options)
        return res.data;
    },
    async updateNewsDetail({ state, dispatch }, options) {
        let url = `${callApi.NEW_DETAIL.EDIT}${options.data.id}`;
        let res = await axios.edit(url, '', options)
        return res.data;
    },
    async createNewsDetail({ state, dispatch }, options) {
        let url = `${callApi.NEW_DETAIL.CREATE}`;
        let res = await axios.create(url, options);
        return res.data;
    },
    async findNewsDetail({ state, dispatch }, [id, options]) {
        let res = await axios.getById(callApi.NEW_DETAIL.SHOW, id, options);
        this.commit("SET_DETTAIL_NEWS", {
            data: res.data.data
        });
        return true;
    },
};
export default {
    state,
    mutations,
    actions
}