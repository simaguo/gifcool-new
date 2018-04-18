import Vue from 'vue'
import Router from 'vue-router'
import {Base64} from 'js-base64'
//import HelloWorld from '@/components/HelloWorld'
import store from '@/store'
import Api from '@/api'

import Index from '@/components/Index'
import Content from '@/components/Content'
import Login from '@/components/Login'
import Regist from '@/components/Regist'
import User from '@/components/User'
import Collection from '@/components/Collection'
import Discover from '@/components/Discover'

Vue.use(Router)

const router = new Router({
    routes: [
        {
            path: '/',
            name: 'Index',
            component: () => import('@/components/Index')
        },
        {
            path: '/content',
            name: 'Content',
            component: () => import('@/components/Content')
        },
        {
            path: '/login',
            name: 'Login',
            component: () => import('@/components/Login')
        },
        {
            path: '/regist',
            name: 'Regist',
            component: () => import('@/components/Regist')
        },
        {
            path: '/user',
            name: 'User',
            component: () => import('@/components/User'),
        },
        {
            path: '/collection',
            name: 'Collection',
            component: () => import('@/components/Collection'),
        },
        {
            path: '/discover',
            name: 'Discover',
            component: () => import('@/components/Discover'),
        }
    ]
})

router.beforeEach((to, from, next) => {
    //console.log({token:store.state.token})
    let token = store.state.token
    if (!token || is_expire(token)) {

        switch (to.name) {
            case 'Collection':
            case 'User':{
                //console.log({to:to.name,from:from.name})
                if(from.name == 'Login'){
                    return ;
                }
                next('login')
            }

        }
    }

    next();
})

function is_expire(token) {
    try{
        let payload = JSON.parse(Base64.decode(token.split('.')[1]))
        //console.log({payload:payload})
        let current = new Date().getTime() / 1000;
        //console.log([payload.exp, 600 + current, payload.exp < 600 + current])
        if (payload.exp < current) {
            return true;
        } else if (payload.exp < 600 + current) {
            Api.refresh();
        }
    }catch (error) {
        console.log({'router is_expire function error':error})
        return true;
    }


    return false;
}

export default router;