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
        DELETE: prefix + `/news/category/delete`,
    },
    NEW_DETAIL: {
        LIST: prefix + `/news/detail/list?`,
        CREATE: prefix + `/news/detail/create`,
        EDIT: prefix + `/news/detail/update/`,
        DELETE: prefix + `/news/detail/delete`,
        SHOW: prefix + `/news/detail/show/`,
    },
    CONFIG_PAGE: {
        LIST: prefix + `/page/list`,
    },
    CONFIG_BLOCK_PAGE: {
        LIST: prefix + `/block/page/list?`,
        CREATE: prefix + `/block/page/create`,
        CONFIG: prefix + `/block/page/config`,
        SHOW: prefix + `/block/page/show/`,
        EDIT: prefix + `/block/page/update/`,
    },
};
export default callApi;
