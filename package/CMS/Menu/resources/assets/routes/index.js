import api from '../../../../../../resources/js/api/index';
import list from '../components/list/list.vue';
import create from '../components/create/create.vue';
export default [{
    path: api.MENU_LIST_ALL,
    name: api.MENU_LIST_ALL,
    component: list
}, {
    path: api.MENU_CREATE,
    name: api.MENU_CREATE,
    component: create
}];