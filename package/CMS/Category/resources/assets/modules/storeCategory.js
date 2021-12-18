import { callAxios } from "../../../../../../resources/js/axios/callAxios";
import callApi from '../../../../../../resources/js/api/callApi';

let axios = new callAxios();
const state = {
    LIST_CATEGORY: [],
    DETAIL_CATEGORY: [],
};

const mutations = {
    SET_LIST_CATEGORY(state, data) {
        state.LIST_CATEGORY = data.data;
    },
    SET_DETAIL_CATEGORY(state, data) {
        state.DETAIL_CATEGORY = data.data;
    }
};

const actions = {
    async getListCategory({ state, dispatch }, options) {
        let res = await axios.getList("/api/admin/category/list?", options);
        this.commit("SET_LIST_CATEGORY", {
            data: res.data.data
        });
        return res.data;
    },
    async findCategoryByID({ state, dispatch }, [id, options]) {
        let res = await axios.getById("/api/admin/category/show/", id, options);

        this.commit('SET_DETAIL_CATEGORY', {
            data: res.data.data
        });
        return res.data;
    },
    async updateCategory({ state, dispatch }, options) {
        let url = `${callApi.CATEGORY.EDIT}${options.data.id}`;
        let res = await axios.edit(url, '', options);
        return res.data;


    },
    async deleteCategoryByID({ state, dispatch }, options) {
        let url = `${callApi.CATEGORY.DELETE}/`;
        let res = await axios.delete(url, options.id, "");
        return res.data;

    },
    async createCategory({ state, dispatch }, options) {
        let url = `${callApi.CATEGORY.CREATE}`;
        let res = await axios.create(url, options);
        return res.data;

    }
};

export default {
    state,
    mutations,
    actions
};
