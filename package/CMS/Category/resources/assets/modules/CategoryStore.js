
import { callAxios } from "../../../../../../resources/js/axios/callAxios";
let axios = new callAxios();

const state  = {
    LIST_CATEGORY : [],
};

const mutations = {
    SET_LIST_CATEGORY (state,data){
        state.LIST_CATEGORY =  data.data;
    }
};

const actions = {
    async getListCategory({state,dispatch},options){
        let res = await axios.getList("/api/admin/category/list?",options);
        this.commit("SET_LIST_CATEGORY",{
            data : res.data.data
        });
        return true;
    }
};

export default {
    state ,
    mutations ,
    actions
};
