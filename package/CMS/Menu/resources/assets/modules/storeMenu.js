import { callAxios } from "../../../../../../resources/js/axios/callAxios";
import callApi from '../../../../../../resources/js/api/callApi';

let axios = new callAxios();
const state = {
    LIST: [],
    DETAIL: [],
};

const mutations = {
    SET_LIST(state, data) {
        state.LIST = data.data;
    },
    SET_DETAIL(state, data) {
        state.DETAIL = data.data;
    }
};

const actions = {
    async getListMenu({ state, dispatch }, options) {
        let res = await axios.getList("/api/admin/menu/list?", options);
        this.commit("SET_LIST", {
            data: res.data.data
        });
        return res.data;
    },
    async findMenu({ state, dispatch }, [id, options]) {
        let res = await axios.getById("/api/admin/menu/show/", id, options);

        this.commit('SET_DETAIL', {
            data: res.data.data
        });
        return res.data;
    },
    async updateMenu({ state, dispatch }, options) {
        let url = `${callApi.MENU.EDIT}${options.data.id}`;
        let res = await axios.edit(url, '', options);
        return res.data;


    },
    async deleteMenu({ state, dispatch }, options) {
        let url = `${callApi.MENU.DELETE}/`;
        let res = await axios.delete(url, options.id, "");
        return res.data;

    },
    async createMenu({ state, dispatch }, options) {
        let url = `${callApi.MENU.CREATE}`;
        let res = await axios.create(url, options);
        return res.data;

    }
};

export default {
    state,
    mutations,
    actions
};