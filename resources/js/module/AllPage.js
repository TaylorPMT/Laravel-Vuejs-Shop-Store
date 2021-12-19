import {
    callAxios
} from "../axios/callAxios";

let axios = new callAxios();
const state = {
    keyPopup: "",
    textPopup: "",
    confirmPopup: false,
    statusAction: false,
    statusDetail: false,
    ERROR_404: false,
};

const mutations = {
    SET_SHOW_POPUP(state, data) {
        state.keyPopup = data.key;
        state.textPopup = data.text;
        state.confirmPopup = true;
    },
    RESET_POPUP(state) {
        state.keyPopup = "";
        state.textPopup = "";
        state.confirmPopup = false;
    },
    //ACTION
    SET_STATUS_ACTION(state) {
        state.statusAction = true;
    },
    RESET_STATUS_ACTION(state) {
        state.statusAction = false;
    },

    //ENDACTION
    //confirm pop up //

    ///end confirm /
    SET_STATUS_DETAIL(state, data) {
        state.statusDetail = data;
    },

    SET_ERROR_404(state) {
        state.ERROR_404 = true;
    },
    RESET_ERROR_404(state) {
        state.ERROR_404 = false;
    }
};
const actions = {
    async getSidebarMenu({ state, commit }, options) {
        let res = await axios.getList("/api/admin/config?siderbar", options);

        return res.data.data

    }
};

export default {
    state,
    mutations,
    actions
};