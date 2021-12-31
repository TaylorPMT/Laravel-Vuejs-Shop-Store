import api from '../../../../../../resources/js/api/index';
import list from '../components/category/list/list.vue';
import create from '../components/category/create/create.vue';
import edit from '../components/category/edit/edit.vue';
import detail_list from '../components/detail/list.vue';
import detail_create from '../components/detail/create.vue';
import detail_edit from '../components/detail/edit.vue';

export default [{
    path: api.NEWS_CATEGORY_LIST,
    name: api.NEWS_CATEGORY_LIST,
    component: list,
}, {
    path: api.NEWS_CATEGORY_CREATE,
    name: api.NEWS_CATEGORY_CREATE,
    component: create,
}, {
    path: api.NEWS_CATEGORY_EDIT,
    name: api.NEWS_CATEGORY_EDIT,
    component: edit,
}, {
    path: api.NEWS_DETAIL,
    name: api.NEWS_DETAIL,
    component: detail_list
}, {
    path: api.NEWS_DETAIL_CREATE,
    name: api.NEWS_DETAIL_CREATE,
    component: detail_create,
}, {
    path: api.NEWS_DETAIL_EDIT,
    name: api.NEWS_DETAIL_EDIT,
    component: detail_edit,
}, ]