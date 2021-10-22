import { callAxios } from "../axios/callAxios";

let axios = new callAxios();
const state = {
    keyPopup: "",
    textPopup: "",
    statusDetail: false,
    menuSidebar: []
};

const mutations = {
    SET_SHOW_POPUP(state, data) {
        state.keyPopup = data.key;
        state.textPopup = data.text;
    },
    RESET_POPUP(state) {
        state.keyPopup = "";
        state.textPopup = "";
    },
    SET_STATUS_DETAIL(state, data) {
        state.statusDetail = data;
    },
    SET_MENU_SIDEBAR(state, data) {
        state.menuSidebar = data.data;
    }
};
const actions = {
    async getSidebar({ state, dispatch }, options) {
        let res = await axios.getList("/api/admin/config?", options);
        this.commit("SET_MENU_SIDEBAR", {
            data: res.data.data
        });
        return true;
    }
};

export default {
    state,
    mutations,
    actions
};
