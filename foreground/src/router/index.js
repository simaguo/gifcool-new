import Vue from 'vue'
import Router from 'vue-router'
//import HelloWorld from '@/components/HelloWorld'
import Index from '@/components/Index'
import Content from '@/components/Content'
import Login from '@/components/Login'
import Regist from '@/components/Regist'

Vue.use(Router)

export default new Router({
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
        }
    ]
})
