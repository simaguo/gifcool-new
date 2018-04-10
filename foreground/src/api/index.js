/**
 * Created by Administrator on 2018-4-8.
 */
import axios from 'axios';

axios.defaults.baseURL = 'http://api.gifcool.cn/v1/';
if (localStorage.getItem('token')) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
}

export default {
    login: function (email, password) {
        return axios.post('/login', {
            email: email,
            password: password,
        })
    },
    regist: function (email, name, password, repassword) {
        return axios.post('/regist', {
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
    comment: function (id, content) {
        return axios.post('/comments', {gif_id: id, content: content});
    }
}