import api from '../../../../../../resources/js/api/index';
import list_block from '../components/block/list.vue';
import create_block from '../components/block/create.vue';
import edit_block from '../components/block/edit.vue';

export default [{
    name: api.LIST_CONFIG_BLOCK,
    path: api.LIST_CONFIG_BLOCK,
    component: list_block
}, {
    name: api.CREATE_CONFIG_BLOCK,
    path: api.CREATE_CONFIG_BLOCK,
    component: create_block
}, {
    name: api.EDIT_CONFIG_BLOCK,
    path: api.EDIT_CONFIG_BLOCK,
    component: edit_block
}]