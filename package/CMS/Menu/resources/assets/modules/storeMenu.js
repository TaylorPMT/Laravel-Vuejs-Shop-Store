import { callAxios } from "../../../../../../resources/js/axios/callAxios";
import callApi from '../../../../../../resources/js/api/callApi';

let axios = new callAxios();
const state = {
    LIST_MENU: [],
    DETAIL_MENU: [],
};

const mutations = {
    SET_LIST_MENU(state, data) {
        state.LIST_MENU = data.data;
    },
    SET_DETAIL_MENU(state, data) {
        state.DETAIL_MENU = data.data;
    }
};

const actions = {
    async getListMenu({ state, dispatch }, options) {
        let res = await axios.getList("/api/admin/menu/list?", options);
        this.commit("SET_LIST_MENU", {
            data: res.data.data
        });
        return res.data;
    },
    async findMENUByID({ state, dispatch }, [id, options]) {
        let res = await axios.getById("/api/admin/menu/show/", id, options);

        this.commit('SET_DETAIL_MENU', {
            data: res.data.data
        });
        return res.data;
    },
    async updateMENU({ state, dispatch }, options) {
        let url = `${callApi.MENU.EDIT}${options.data.id}`;
        let res = await axios.edit(url, '', options);
        return res.data;


    },
    async deleteMenuByID({ state, dispatch }, options) {
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