import api from '../../../../../../resources/js/api/index';
import list from '../components/list/list.vue';
import edit from '../components/edit/edit.vue';
import create from '../components/create/create.vue';
export default [{
        path: api.CATEGORY_LIST_ALL,
        name: api.CATEGORY_LIST_ALL,
        component: list,
    },
    {
        path: api.CATEGORY_EDIT_LIST_ALL,
        name: api.CATEGORY_EDIT_LIST_ALL,
        component: edit,
    },
    {
        path: api.CATEGORY_CREATE,
        name: api.CATEGORY_CREATE,
        component: create,
    }
]