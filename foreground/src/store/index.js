/**
 * Created by Administrator on 2018-4-8.
 */
import Vue from 'vue'
import Vuex from 'vuex'
import { Base64 } from 'js-base64'
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
        setToken:function(state,token){
            localStorage.setItem('token',token);
            this.state.token = token;
        },
        setEmail:function(state,email){
            localStorage.setItem('token',email);
            this.state.email = email;
        },
        setAvatar:function(state,avatar){
            localStorage.setItem('avatar',avatar);
            this.state.avatar = avatar;
        },
        setName:function(state,name){
            localStorage.setItem('name',name);
            this.state.name = name;
        },
        setUid:function(state,uid){
            localStorage.setItem('uid',uid);
            this.state.uid = uid;
        },
        setUser:function(state,user){
            try{
                //console.log({'vuex ustr':ustr})
                //let user = JSON.parse(Base64.decode(ustr));
                //console.log({'vuex ustr parse':user})
                this.commit('setAvatar',user.avatar);
                this.commit('setEmail',user.email);
                this.commit('setName',user.name);
                this.commit('setToken',user.token);
                this.commit('setUid',user.uid)
            }catch (error){
                console.log({'vuex setUser error':error});
            }

        },
        logout:function (state) {
            this.commit('setAvatar',null);
            this.commit('setEmail',null);
            this.commit('setName',null);
            this.commit('setToken',null);
            this.commit('setUid',null)
        }
    },
    actions:{
        refresh:function (context,token) {
            context.commit('setToken',token);
        },
        login:function(context,user){
            if(typeof user == 'object'){
                //let ustr = Base64.encode(JSON.stringify(user));
                //console.log({ustr:ustr})
                context.commit('setUser',user)
            }
        },
        regist:function(context,user){
            if(typeof user == 'object'){
                //let ustr = Base64.encode(JSON.stringify(user));
                //console.log({ustr:ustr})
                context.commit('setUser',user)
            }
        },
        logout:function(context){
            context.commit('logout')
        }

    }

})
