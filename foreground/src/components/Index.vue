<template>

    <section>
        <mt-navbar v-model="selected">
            <mt-tab-item id="x1">动图</mt-tab-item>
            <mt-tab-item id="x2">图文</mt-tab-item>
            <mt-tab-item id="x3">文章</mt-tab-item>
        </mt-navbar>

        <!-- tab-container -->
        <mt-tab-container v-model="selected">
            <mt-tab-container-item id="x1">
                <article class="cont-li" v-for="(value, key) in gifs">
                    <div>
                        <header style="padding: 8px 16px;">
                            <router-link :to="{name: 'Content',query: {id:value.id}}">{{ value.title }}</router-link>
                        </header>
                        <img style="width: 100%" v-lazy="value.url"/>
                    </div>

                    <footer style="padding: 8px 16px;">
                        <router-link style="margin-right: 35px;" :to="{name: 'Content',query: {id:value.id}}"><icon name="commenting"></icon>{{ value.comments }}</router-link>

                        <span style="margin-right: 5px;float: right" v-show="1!=value.support"
                              @click="up(value.id,key,1)"><icon name="thumbs-o-up"></icon>{{ value.up }}</span>
                        <span style="margin-right: 5px;float: right" v-show="1==value.support"
                              @click="up(value.id,key,1)"><icon name="thumbs-up"></icon>{{ value.up }}</span>

                        <span style="margin-right: 15px;float: right" v-show="2!=value.support"
                              @click="down(value.id,key,2)"><icon name="thumbs-o-down"></icon>{{ value.down }}</span>
                        <span style="margin-right: 15px;float: right" v-show="2==value.support"
                              @click="down(value.id,key,2)"><icon name="thumbs-down"></icon>{{ value.down }}</span>

                        <span style="margin-right: 25px;float: right" v-show="!value.collect"
                              @click="collect(value.id,key)"><icon name="heart-o"></icon></span>
                        <span style="margin-right: 25px;float: right" v-show="value.collect"
                              @click="collect(value.id,key)"><icon name="heart"></icon></span>

                    </footer>
                </article>

            </mt-tab-container-item>
            <mt-tab-container-item id="x2">
                <mt-cell v-for="n in 4" :key="n" :title="'测试 ' + n"/>
            </mt-tab-container-item>
            <mt-tab-container-item id="x3">
                <mt-cell v-for="n in 6" :key="n" :title="'选项 ' + n"/>
            </mt-tab-container-item>
        </mt-tab-container>

    </section>


</template>

<script>
    import Api from '@/api'
    export default {
        name: 'Index',
        data () {
            return {
                selected: 'x1',
                img: 'https://tse3.mm.bing.net/th?id=OIP.hT034blVsi-A1ChdKgQM9gHaE-&pid=Api',
                gifs: []
            }
        },
        methods: {
            load(){
                let _this = this;
                Api.gifs().then(function (response) {
                    _this.gifs = response.data.data
                    //console.group(_this.gifs)
                }).catch(function (error) {
                    _this.$toast(error.response.data.message);
                });
            },
            collect: function (gif_id, key) {
                let _this = this;
                _this.$data.gifs[key].collect = !_this.$data.gifs[key].collect;
                Api.collect(gif_id).then(function () {

                }).catch(function (error) {
                    if (error.response.status == 401) {
                        _this.$toast("未登录授权");
                        _this.$router.push('login');
                    }
                })
            },
            up: function (gif_id, key, value) {
                let _this = this;
                if(_this.$data.gifs[key].support ==value){
                    return
                }
                if(_this.$data.gifs[key].support !=0){
                    _this.$data.gifs[key].down--;
                }
                _this.$data.gifs[key].up++;
                _this.$data.gifs[key].support = value;
                Api.up(gif_id).then(function () {

                }).catch(function (error) {
                    if (error.response.status == 401) {
                        _this.$toast("未登录授权");
                        _this.$router.push('login');
                    }
                })
            },
            down: function (gif_id, key, value) {
                let _this = this;
                if(_this.$data.gifs[key].support ==value){
                    return
                }
                if(_this.$data.gifs[key].support !=0){
                    _this.$data.gifs[key].up--;
                }
                _this.$data.gifs[key].down++;
                _this.$data.gifs[key].support = value;
                Api.down(gif_id).then(function () {

                }).catch(function (error) {
                    if (error.response.status == 401) {
                        _this.$toast("未登录授权");
                        _this.$router.push('login');
                    }
                })
            },
        },
        mounted: function () {
            this.load()
        }
    }
</script>
<style>
    image[lazy=loading] {
        height: 200px;
        width: 100%;
        /*width: 40px;
        height: 300px;
        margin: auto;*/
    }

    .cont-li {
        border-top: #666666 1px solid;
    }
</style>