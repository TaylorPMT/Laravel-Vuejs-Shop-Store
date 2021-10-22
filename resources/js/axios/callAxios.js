import { setupAxios } from "./axios";
import axios from "axios";

const access_token = localStorage.getItem("access_token");

let domain = DOMAIN.split("");

if (domain[domain.length - 1] == "/") {
    domain.splice(domain.length - 1, 1);
    domain = domain.join("");
} else {
    domain = domain.join("");
}

const GATE_API = domain;

const callAxios = function() {
    // login
    this.login = async function(url, data) {
        const API_URL = GATE_API + (url ? url : "");

        let option = {
            method: "POST",
            url: API_URL,
            data
        };
        let res = await setupAxios(option);
        return res;
    };

    //Lấy danh sách với method GET theo params như dưới
    this.getList = async function(url, options) {
        let params = [];
        if (options.hasOwnProperty("key_word") && options.key_word != "") {
            params.push(`key_word=${options.key_word}`);
        }
        if (options.hasOwnProperty("order_by") && options.order_by != "") {
            params.push(`order_by=${options.order_by}`);
        }
        if (options.hasOwnProperty("sort_by") && options.sort_by != "") {
            params.push(`sort_by=${options.sort_by}`);
        }
        if (options.hasOwnProperty("per_page") && options.per_page != "") {
            params.push(`per_page=${options.per_page}`);
        }
        if (options.hasOwnProperty("page") && options.page != "") {
            params.push(`page=${options.page}`);
        }
        let option = {
            method: "GET",
            url: GATE_API + (url ? url + `${params.join("&")}` : ""),
            headers: { Authorization: access_token },
            data: options.hasOwnProperty("data") ? options.data : "",
            params: options.hasOwnProperty("params") ? options.params : ""
        };
        let res = await setupAxios(option);
        return res;
    };
    this.get   = async function(url){
        let access_token = localStorage.getItem("access_token");
        let option = {
            method: "GET",
            url: GATE_API + (`${url ? url : ""}`),
            headers: { Authorization: access_token },
        };
        let res = await setupAxios(option);
        return res;
    };
    this.getById = async function(url, id, options) {
        let access_token = localStorage.getItem("access_token");

        let option = {
            method: "GET",
            url: GATE_API + (`${url ? url : ""}` + id),
            headers: { Authorization: access_token },
            data: options.hasOwnProperty("data") ? options.data : "",
            params: options.hasOwnProperty("params") ? options.params : ""
        };
        let res = await setupAxios(option);
        return res;
    };

    this.create = async function(url, options) {
        let option = {
            method: "POST",
            url: GATE_API + (url ? url : ""),
            headers: options.hasOwnProperty("headers")
                ? { Authorization: access_token, ...options.headers }
                : { Authorization: access_token },
            data: options.hasOwnProperty("data") ? options.data : "",
            params: options.hasOwnProperty("params") ? options.params : ""
        };
        let res = await setupAxios(option);
        return res;
    };

    this.edit = async function(url, id, options) {
        let option = {
            method: "PUT",
            url: GATE_API + (`${url ? url : ""}` + id),
            headers: { Authorization: access_token },
            data: options.hasOwnProperty("data") ? options.data : "",
            params: options.hasOwnProperty("params") ? options.params : ""
        };

        let res = await setupAxios(option);
        return res;
    };

    this.patchData = async function(url, options) {
        let option = {
            method: "PATCH",
            url: GATE_API + (url ? url : ""),
            headers: { Authorization: access_token },
            data: options.hasOwnProperty("data") ? options.data : "",
            params: options.hasOwnProperty("params") ? options.params : ""
        };
        let res = await setupAxios(option);
        return res;
    };

    this.delete = async function(url, id, options) {
        let option = {
            method: "DELETE",
            url: GATE_API + (`${url ? url : ""}` + id),
            headers: { Authorization: access_token },
            data: options.hasOwnProperty("data") ? options.data : "",
            params: options.hasOwnProperty("params") ? options.params : ""
        };
        let res = await setupAxios(option);
        return res;
    };

    this.deleteList = async function(url, options) {
        let option = {
            method: "POST",
            url: GATE_API + `${url ? url : ""}`,
            headers: { Authorization: access_token },
            data: options.hasOwnProperty("data") ? options.data : "",
            params: options.hasOwnProperty("params") ? options.params : ""
        };
        let res = await setupAxios(option);
        return res;
    };
};

export { callAxios };
