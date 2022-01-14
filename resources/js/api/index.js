const api = {
    //category //
    CATEGORY_LIST_ALL: '/admin/category',
    CATEGORY_EDIT_LIST_ALL: '/admin/category/:id/edit',
    CATEGORY_CREATE: '/admin/category/create',

    //product
    PRODUCT_LIST_ALL: '/admin/product',
    PRODUCT_CREATE: '/admin/product/create',
    PRODUCT_EDIT: '/admin/product/:id/edit',

    //Menu
    MENU_LIST_ALL: '/admin/menu',
    MENU_CREATE: '/admin/menu/create',
    MENU_EDIT: '/admin/menu/:id/edit',

    //News category
    NEWS_CATEGORY_LIST: '/admin/news/category',
    NEWS_CATEGORY_CREATE: '/admin/news/category/create',
    NEWS_CATEGORY_EDIT: '/admin/news/category/:id/edit',

    //news detail
    NEWS_DETAIL: '/admin/news/detail',
    NEWS_DETAIL_CREATE: '/admin/news/detail/create',
    NEWS_DETAIL_EDIT: '/admin/news/detail/:id/edit',

    // quan ly page
    LIST_PAGE_HOME: '/admin/page',
    LIST_PAGE_CREATE: '/admin/page/create',
    LIST_PAGE_EDIT: '/admin/page/:id/edit',

    // quan ly block
    LIST_CONFIG_BLOCK: `/admin/block/page`,
    CREATE_CONFIG_BLOCK: `/admin/block/page/create`,
    EDIT_CONFIG_BLOCK: `/admin/block/page/:id/edit`,

}
export default api;