import api from '../../../../../../resources/js/api/index';
import list from '../components/list/list.vue';
import create from '../components/create/create.vue';
import edit from '../components/edit/edit.vue';
export default [{
        path: api.PRODUCT_LIST_ALL,
        name: api.PRODUCT_LIST_ALL,
        component: list,
    },
    {
        path: api.PRODUCT_CREATE,
        name: api.PRODUCT_CREATE,
        component: create
    },
    {
        path: api.PRODUCT_EDIT,
        name: api.PRODUCT_EDIT,
        component: edit
    }

]
