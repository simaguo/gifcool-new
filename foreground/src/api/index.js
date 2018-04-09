/**
 * Created by Administrator on 2018-4-8.
 */
import axios from 'axios';

axios.defaults.baseURL = 'http://api.gifcool.cn';
if(localStorage.getItem('token')){
    axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('token');
}

export default {
    login: function (email, password) {
        return axios.post('/v1/login', {
            email: email,
            password: password,
        })
    },
    regist:function(email,name,password,repassword){
        return axios.post('/v1/regist',{
            email:email,
            name:name,
            password:password,
            repassword:repassword
        })
    },
    gifs:function(){
        return axios.get('/v1/gifs')
    }
}