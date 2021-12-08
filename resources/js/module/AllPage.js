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
    menuSidebar: [],
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
    SET_MENU_SIDEBAR(state, data) {
        state.menuSidebar = data.data;
    },
    SET_ERROR_404(state) {
        state.ERROR_404 = true;
    },
    RESET_ERROR_404(state) {
        state.ERROR_404 = false;
    }
};
const actions = {
    async getSidebar({
        state,
        dispatch
    }, options) {
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