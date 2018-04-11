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
            component: Index
        },
        {
            path: '/content',
            name: 'Content',
            component: Content
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/regist',
            name: 'Regist',
            component: Regist
        },
        {
            path: '/user',
            name: 'User',
            component: User,
        },
        {
            path: '/collection',
            name: 'Collection',
            component: Collection,
        },
        {
            path: '/discover',
            name: 'Discover',
            component: Discover,
        }
    ]
})

router.beforeEach((to, from, next) => {
    //console.log({token:store.state.token})
    let token = store.state.token
    if (!token || is_expire(token)) {
        switch (to.name) {
            case 'Collection':
            case 'User':
                next('login')
        }
    }

    next();
})

function is_expire(token) {
    let payload = JSON.parse(Base64.decode(token.split('.')[1]))
    //console.log({payload:payload})
    let current = new Date().getTime() / 1000;
    console.log([payload.exp, 600 + current, payload.exp < 600 + current])
    if (payload.exp < current) {
        return true;
    } else if (payload.exp < 600 + current) {
        Api.refresh();
    }

    return false;
}

export default router;