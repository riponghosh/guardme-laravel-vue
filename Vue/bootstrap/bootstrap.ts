import Vue from "vue";

declare var require:any;
declare var window:any;

window._ = require('lodash');
window.Vue = Vue;
window.axios = require('axios');
window.bus = new Vue();

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token:any = document.head.querySelector('meta[name="csrf-token"]');
let api_token:any = document.head.querySelector('meta[name="api-token"]');


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Content-Type'] = 'application/json';
//window.axios.defaults.baseURL = ``;
window.axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found!');
}

window.axios.interceptors.request.use(function (config: any) {
    // Do something before request is sent

    config.params = config.params || {};
    config.params.api_token = api_token.content;
    return config;
}, function (error: any) {
    // Do something with request error
    return Promise.reject(error);
});

window.axios.interceptors.response.use(function (response: any) {
    // Do something with response data
    return response;
}, function (error: any) {
    if(error.response.data.errors){
        window.bus.$emit('RESPONSE_ERRORS', error.response.data.errors);
    } else {
        alert(error.response.data.message);
    }
    return Promise.reject(error);
});