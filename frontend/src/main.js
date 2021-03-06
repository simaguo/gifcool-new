// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import {
    Toast,
    Indicator,
    InfiniteScroll,
    Actionsheet,
    Lazyload,
    Header,
    Navbar,
    Tabbar,
    TabItem,
    TabContainer,
    TabContainerItem,
    Button,
    Search,
    Field
} from 'mint-ui'
import 'mint-ui/lib/style.css'
import 'vue-awesome/icons/commenting'
import 'vue-awesome/icons/commenting-o'
import 'vue-awesome/icons/heart'
import 'vue-awesome/icons/heart-o'
import 'vue-awesome/icons/thumbs-up'
import 'vue-awesome/icons/thumbs-o-up'
import 'vue-awesome/icons/thumbs-down'
import 'vue-awesome/icons/thumbs-o-down'
import 'vue-awesome/icons/edit'
import 'vue-awesome/icons/user-o'
import 'vue-awesome/icons/send-o'
import 'vue-awesome/icons/home'
import 'vue-awesome/icons/compass'
import 'vue-awesome/icons/bookmark-o'
import 'vue-awesome/icons/spinner'

import store from './store/';


import Icon from 'vue-awesome/components/Icon'
Vue.component('icon', Icon)


Vue.$toast = Vue.prototype.$toast = Toast;
Vue.$indicator = Vue.prototype.$indicator = Indicator;
Vue.use(InfiniteScroll);
Vue.component(Actionsheet.name, Actionsheet);
Vue.use(Lazyload);

Vue.component(Header.name, Header);
Vue.component(Navbar.name, Navbar);
Vue.component(TabItem.name, TabItem);

Vue.component(TabContainer.name, TabContainer);
Vue.component(TabContainerItem.name, TabContainerItem);

Vue.component(Tabbar.name, Tabbar);
Vue.component(TabItem.name, TabItem);

Vue.component(Button.name, Button);
Vue.component(Search.name, Search);
Vue.component(Field.name, Field);

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router, store,
    components: {App},
    template: '<App/>'
})
