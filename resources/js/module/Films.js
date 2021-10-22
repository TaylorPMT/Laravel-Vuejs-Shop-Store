import { callAxios } from "../axios/callAxios";
let axios = new callAxios();
const state = {
    LIST_FILM: []
};

const mutations = {
    SET_LIST_FILM(state, data) {
        state.LIST_FILM = data.data;
    }
};
const actions = {
    async getListFilm({ state, dispatch }, options) {
        let res = await axios.getList("/api/admin/film/list?", options);

        this.commit("SET_LIST_FILM", {
            data: res.data.data
        });
        return true;
    },
    async downloadFilm({state, dispatch},id) {
        let res = await axios.getById("/api/admin/film/download/",id,"");
        if(res.data.response_code ==200) {
            return true;
        }
    }
};

export default {
    state,
    mutations,
    actions
};
