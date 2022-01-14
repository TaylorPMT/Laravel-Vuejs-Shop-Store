import api from '../../../../../../resources/js/api/index';
import list from '../components/list/list.vue';
import create from '../components/create/create.vue';
import edit from '../components/edit/edit.vue';
import list_home from '../components/page/list.vue';
import edit_page from '../components/page/edit.vue';
import create_page from '../components/page/create.vue';
export default [{
        path: api.MENU_LIST_ALL,
        name: api.MENU_LIST_ALL,
        component: list
    }, {
        path: api.MENU_CREATE,
        name: api.MENU_CREATE,
        component: create
    }, {
        path: api.MENU_EDIT,
        name: api.MENU_EDIT,
        component: edit,
    }, {
        path: api.LIST_PAGE_HOME,
        name: api.LIST_PAGE_HOME,
        component: list_home,
    },
    {
        path: api.LIST_PAGE_EDIT,
        name: api.LIST_PAGE_EDIT,
        component: edit_page,
    },
    {
        path: api.LIST_PAGE_CREATE,
        name: api.LIST_PAGE_CREATE,
        component: create_page,
    },
];