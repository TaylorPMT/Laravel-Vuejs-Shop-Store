const prefix = `/api/admin`;
const callApi = {
    CATEGORY: {
        EDIT: prefix + `/category/update/`,
        DELETE: prefix + `/category/delete`,
    },
};
export default callApi;