import Vue from 'vue';
import * as typos from './mutation-types';

import axios from "axios";
const BASE_API_URL = process.env.MIX_BASE_API_URL;

const API = axios.create({
    baseURL: String(BASE_API_URL),
    timeout: 30000,
    headers: {
        "Content-Type": "application/json"
    }
});


export default {
    /**
     * @param {ActionContext} [vuexContext]
     * @param {Object} payload
     * @return {void}
     */

    setError({ commit }, errorCode) {
        commit(typos.SET_ERROR, errorCode);
    },
    removeError({ commit }) {
        commit(typos.REMOVE_ERROR);
    },
    resetState({ commit }) {
        commit(typos.RESET_STATE);
    },
    getHello(context) {
        const API_IP_ENDPOINT = "v2/5ed7144932000035002744d0";

        API.get(API_IP_ENDPOINT)
            .then(response => {
                console.log(response);
                context.commit("dados", response.data.hello); //categories will be run from mutation
            })
            .catch(() => {
                console.log("Error........");
            });
    },
    getHello({ commit }) {
        const API_URL_ENDPOINT = "v2/5ed7144932000035002744d0";
        
        commit(typos.SET_LOADING, true);
        API.get(API_URL_ENDPOINT)
            .then(res => {
                const payload = { ...res.data };
                console.log(res.data)

                commit(typos.SET_HELLO, payload);
            })
            .catch(err => {
                commit(typos.SET_ERROR, err);
            })
            .then(() => {
                commit(typos.SET_LOADING, false);
            });
    }
};
