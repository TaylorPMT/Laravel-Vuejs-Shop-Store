import { callAxios } from "../../../../../../resources/js/axios/callAxios";
import callApi from '../../../../../../resources/js/api/callApi';
let axios = new callAxios();

const state = {
    LIST_NEWS_CATEGORY: [],
    DETAIL_NEWS_CATEGORY: []
};
const mutations = {
    SET_LIST_NEWS_CATEGORY(state, data) {
        state.LIST_NEWS_CATEGORY = data.data;
    },
    SET_DETAIL_NEWS_CATEGORY(state, data) {
        state.DETAIL_NEWS_CATEGORY = data.data;
    }
};
const actions = {
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
    async updateNewsCategory({ state, dispatch }, options) {
        let url = `${callApi.NEWS_CATEGORY.EDIT}${options.data.id}`;
        let res = await axios.edit(url, '', options)
        return res.data;
    }
};
export default {
    state,
    mutations,
    actions
}
