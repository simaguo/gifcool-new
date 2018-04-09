import Vue from 'vue'
import Router from 'vue-router'
//import HelloWorld from '@/components/HelloWorld'
import store from '@/store'

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
            path:'/user',
            name:'User',
            component:User,
        },
        {
            path:'/collection',
            name:'Collection',
            component:Collection,
        },
        {
            path:'/discover',
            name:'Discover',
            component:Discover,
        }
    ]
})

router.beforeEach((to, from, next) => {
    console.log(store.state.token)
    if(!store.state.token){
        switch (to.name){
            case 'Collection':
            case 'User':
                next('login')
        }
    }

    next();
})

export default router;