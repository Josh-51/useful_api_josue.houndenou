export default {

    apiBaseURL: "http://127.0.0.1:9000/api",

};

import axios from "axios";
import config from "./config.js";

const  baseUrl  = config.apiBaseURL ;

function getToken() {
    const user = JSON.parse(localStorage.getItem("user"));
    console.log(baseUrl);
    if (user) {
        return user.token;
    }
    return "";
}

const api = axios.create({
    baseURL: baseUrl,
    headers: {
        "Content-Type": "application/json",
        Authorization: getToken()
            ? `Bearer ${getToken()}`
            : ""
    }
});


export const setToken = (token) => {
    localStorage.setItem("token", token);
    api.defaults.headers.Authorization = `Bearer ${token}`;
};

export const removeToken = () => {
    localStorage.removeItem("token");
    api.defaults.headers.Authorization = 'Bearer ';
}

export default api;

import api from "./utils";

export default {

    async register (data) {
        // console.log(data)

        try {
            const res =  await api.post("/register", data)
            console.log(res.data)
            return res.data
        } catch (e) {
            this.error = e.response?.data?.message || e.message;
            console.log(this.error);

            return null;
            // throw e;
        }
    },

    async login (data) {
        // console.log(data)
        try {
            const res =  await api.post("/login", data)
            // console.log(res.data)
            localStorage.setItem("user", JSON.stringify( res.data ) );

            console.log(res.data)
            return res.data
        } catch (e) {
            this.error = e.response?.data?.message || e.message;
            console.log(this.error);

            return null;
            // throw e;
        }
    },

    async logout () {
        console.log()
        try {
            const res = await api.post("/logout")

            console.log(res.data?.message);

            localStorage.removeItem("user");

        } catch (e) {
            this.error = e.response?.data?.message || e.message;
            // throw e;
            console.log(this.error);
        }
    },


};
