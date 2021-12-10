import { callAxios } from "../../../../../../resources/js/axios/callAxios";
import callApi from '../../../../../../resources/js/api/callApi';

let axios = new callAxios();
const state = {
    LIST_PRODUCT: [],
};

const mutations = {
    SET_LIST_PRODUCT(state, data) {
        state.LIST_PRODUCT = data.data;
    }
};

const actions = {
    async getListProduct({ state, dispatch }, options) {
        let res = await axios.getList(callApi.PRODUCT.LIST, options);
        this.commit("SET_LIST_PRODUCT", {
            data: res.data.data
        });
        return res.data;
    }
};
export default {
    state,
    mutations,
    actions
};