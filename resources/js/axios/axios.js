import axios from "axios";
axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === 401) {
            // location.reload();
            let login = DOMAIN + "login";
            window.localStorage.clear();
            window.location.href = "/login";
        }
        return Promise.reject(error);
    }
);

const setupAxios = function(options) {
    return axios({
        method: options.hasOwnProperty("method") ? options.method : "",
        url: options.hasOwnProperty("url") ? options.url : "",
        headers: options.hasOwnProperty("headers") ? options.headers : "",
        params: options.hasOwnProperty("params") ? options.params : "",
        data: options.hasOwnProperty("data") ? options.data : ""
    })
        .then(res => {
            return res;
        })
        .catch(err => {
            return err;
        });
};

export { setupAxios };
