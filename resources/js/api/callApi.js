const prefix = `/api/admin`;
const callApi = {
    CATEGORY: {
        EDIT: prefix + `/category/update/`,
        DELETE: prefix + `/category/delete`,
        CREATE: prefix + `/category/create`,
    },
    PRODUCT: {
        LIST: prefix + `/product/list?`,
        CREATE: prefix + `/product/create`,
    },
};
export default callApi;