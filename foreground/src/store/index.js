/**
 * Created by Administrator on 2018-4-8.
 */
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token: localStorage.getItem('token'),
        email: localStorage.getItem('email'),
        avatar: localStorage.getItem('avatar'),
        name: localStorage.getItem('name'),
    },
    getters:{

    },
    mutations: {

    },
    actions:{
        login:function(context,user){
            localStorage.setItem('token',user.token);
            localStorage.setItem('email',user.email);
            localStorage.setItem('avatar',user.avatar);
            localStorage.setItem('name',user.name);
        },
        regist:function(context,user){
            localStorage.setItem('token',user.token);
            localStorage.setItem('email',user.email);
            localStorage.setItem('avatar',user.avatar);
            localStorage.setItem('name',user.name);
        },

    }

})
