import { callAxios } from "../../../../../../resources/js/axios/callAxios";
import callApi from '../../../../../../resources/js/api/callApi';

let axios = new callAxios();
const state = {
    CONFIG_BLOCK: [],
    LIST_BLOCK: [],
    DETAIL_CONFIG_BLOCK: [],
};

const mutations = {
    SET_LIST_CONFIG_CONFIG_BLOCK(state, data) {
        state.CONFIG_BLOCK = data.data;
    },
    SET_LIST_BLOCK(state, data) {
        state.LIST_BLOCK = data.data;
    },
    SET_DETAIL_CONFIG_BLOCK(state, data) {
        state.DETAIL_CONFIG_BLOCK = data.data;
    }
};

const actions = {
    async createPageBlock({ state, dispatch }, options) {
        let res = await axios.create(callApi.CONFIG_BLOCK_PAGE.CREATE, options);
        return res.data;
    },
    async getPageBlock({ state, dispatch }, options) {
        let res = await axios.getList(callApi.CONFIG_BLOCK_PAGE.CONFIG, options);
        this.commit("SET_LIST_CONFIG_CONFIG_BLOCK", {
            data: res.data.data
        });
        return true;
    },
    async getListPageBlock({ state, dispatch }, options) {
        let res = await axios.getList(callApi.CONFIG_BLOCK_PAGE.LIST, options);
        this.commit("SET_LIST_BLOCK", {
            data: res.data.data
        });
    },
    async findPageBlock({ state, dispatch }, [id, options]) {
        let res = await axios.getById(callApi.CONFIG_BLOCK_PAGE.SHOW, id, options);
        this.commit("SET_DETAIL_CONFIG_BLOCK", {
            data: res.data.data
        });
    },
    async updatePageBlock({ state, dispatch }, options) {
        let url = `${callApi.CONFIG_BLOCK_PAGE.EDIT}${options.data.id}`;
        let res = await axios.edit(url, '', options)
        return res.data;
    },
};

export default {
    state,
    mutations,
    actions
};
