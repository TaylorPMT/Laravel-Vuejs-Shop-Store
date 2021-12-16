import { callAxios } from "../../../../../../resources/js/axios/callAxios";
import callApi from '../../../../../../resources/js/api/callApi';

let axios = new callAxios();
const state = {
    LIST_PRODUCT: [],
    DETAIL_PRODUCT: {}
};

const mutations = {
    SET_LIST_PRODUCT(state, data) {
        state.LIST_PRODUCT = data.data;
    },
    SET_DETAIL_PRODUCT(state, data) {
        state.DETAIL_PRODUCT = data.data
    }

};

const actions = {
    async getListProduct({ state, dispatch }, options) {
        let res = await axios.getList(callApi.PRODUCT.LIST, options);
        this.commit("SET_LIST_PRODUCT", {
            data: res.data.data
        });
        return res.data;
    },
    async createProduct({ state, dispatch }, options) {
        let url = `${callApi.PRODUCT.CREATE}`;
        let res = await axios.create(url, options);
        return res.data;
    },
    async findProduct({ state, dispatch }, [id, options]) {
        let res = await axios.getById("/api/admin/product/show/", id, options);
        this.commit('SET_DETAIL_PRODUCT', {
            data: res.data.data
        });
        return res.data;
    },
    async updateProduct({ state, dispatch }, options) {
        let url = `${callApi.PRODUCT.EDIT}${options.data.id}`;
        let res = await axios.edit(url, '', options);
        return res.data;
    },
    async deleteProduct({ state, dispatch }, options) {
        let url = `${callApi.PRODUCT.DELETE}${options.id}`;
        let res = await axios.delete(url, '', options);
        return res.data;
    },
};
export default {
    state,
    mutations,
    actions
};