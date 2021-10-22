import { callAxios } from "../axios/callAxios";

let axios = new callAxios();
const state = {
    ADMIN: {},
    LIST_USER_ITEMS: []
};

const mutations = {
    SET_DATA_ADMIN(state, data) {
        state.ADMIN = data.info;
    },
    SET_DATA_USER_ITEMS(state, data) {
        state.LIST_USER_ITEMS = data.data;
    }
};
const actions = {
    async loginUser({ state, dispatch }, data) {
        let res = await axios.login("/api/admin/login", data);
        return res;
    },
    async getUserById({ state, dispatch }, id) {
        let res = await axios.getById("/api/admin/", "info", "");
        if (res.data.error == null && res.data.response_code == 200) {
            this.commit("SET_DATA_ADMIN", {
                info: res.data.data
            });
        }
    },
    async getListUsers({ state, dispatch }, options) {
        let res = await axios.getList("/api/admin/list?", options);
        if (res.data.error == null && res.data.response_code == 200) {
            this.commit("SET_DATA_USER_ITEMS", {
                data: res.data.data
            });
        }
    },
    async logout({ state, dispatch }, data) {
        let res = await axios.getById("/api/admin/", "logout", "");
        return res;
    }
};
export default {
    state,
    mutations,
    actions
};
