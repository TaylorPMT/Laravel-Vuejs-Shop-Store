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
        EDIT: prefix + `/product/update/`,
        DELETE: prefix + `/product/delete/`,
    },
    MENU: {
        LIST: prefix + `/menu/list?`,
        CREATE: prefix + `/menu/create`,
        EDIT: prefix + `/menu/update/`,
        DELETE: prefix + `/menu/delete`,
        ORDER: prefix + `/menu/order`,
    },
    NEWS_CATEGORY: {
        LIST: prefix + `/news/category/list?`,
        CREATE: prefix + `/news/category/create`,
        SHOW: prefix + `/news/category/show/`,
        EDIT: prefix + `/news/category/update/`,
    }
};
export default callApi;
