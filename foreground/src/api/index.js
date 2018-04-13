/**
 * Created by Administrator on 2018-4-8.
 */
import axios from 'axios';
import store from '@/store'
import router from '@/router'

axios.defaults.baseURL = 'http://api.gifcool.cn/v1/';
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

/*if (store.state.token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.token;
}*/
axios.interceptors.request.use(function (config) {
    // Do something before request is sent
    //console.log(config)
    //console.log(axios.defaults.headers.common['Authorization'])
    //console.log(store.state.token)
    if(store.state.token){
        config.headers.common['Authorization'] = 'Bearer ' + store.state.token;
    }
    //console.log(config)
    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

export default {
    refresh: function () {
        axios.post('/auth/refresh').then(function (response) {
            let token = response.data.data;
            store.dispatch('refresh', token);
        })
    },
    login: function (email, password) {
        return axios.post('/auth/login', {
            email: email,
            password: password,
        })
    },
    regist: function (email, name, password, repassword) {
        return axios.post('/auth/regist', {
            email: email,
            name: name,
            password: password,
            repassword: repassword
        })
    },
    gifs: function () {
        return axios.get('/gifs')
    },
    gif: function (id) {
        return axios.get('/gifs/' + id)
    },
    comments: function (id) {
        return axios.get('/gifs/' + id + '/comments')
    },
    collections:function(){
        return axios.get('/collections')
    },
    comment: function (id, content) {
        return axios.post('/comments', {gif_id: id, content: content});
    },
    collect: function (id) {
        if(store.token){
            router.push('login');
        }
        return axios.post('/gifs/collect', {gif_id: id})
    },
    up: function (id) {
        if(store.token){
            router.push('login');
        }
        return axios.post('/gifs/up', {gif_id: id})
    },
    down: function (id) {
        if(store.token){
            router.push('login');
        }
        return axios.post('/gifs/down', {gif_id: id})
    }
}