<template>
    <mt-search
            v-model.trim="search"
            cancel-text="取消"
            placeholder="搜索"
            :autofocus="true"
            :result.sync="gifs"
            v-on:input="changeSearchValue">

        <section class="discover">
            <article class="cont-li" v-for="(value, key) in gifs">
                <div>
                    <header style="padding: 8px 16px;">
                        <router-link :to="{name: 'Content',query: {id:value.id}}">{{ value.title }}</router-link>
                    </header>
                    <img v-lazy="imgObj(value.url)"/>
                </div>

                <footer style="padding: 8px 16px;">
                    <router-link style="margin-right: 35px;" :to="{name: 'Content',query: {id:value.id}}">
                        <icon name="commenting" :scale="scale"></icon>
                        {{ value.comments }}

                    </router-link>

                    <span style="margin-right: 5px;float: right" v-show="1!=value.support"
                          @click="up(value.id,key,1)"><icon name="thumbs-o-up" :scale="scale"></icon>{{ value.up
                        }}</span>
                    <span style="margin-right: 5px;float: right" v-show="1==value.support"
                          @click="up(value.id,key,1)"><icon name="thumbs-up" :scale="scale"></icon>{{ value.up }}</span>

                    <span style="margin-right: 15px;float: right" v-show="2!=value.support"
                          @click="down(value.id,key,2)"><icon name="thumbs-o-down" :scale="scale"></icon>{{ value.down
                        }}</span>
                    <span style="margin-right: 15px;float: right" v-show="2==value.support"
                          @click="down(value.id,key,2)"><icon name="thumbs-down" :scale="scale"></icon>{{ value.down
                        }}</span>

                    <span style="margin-right: 25px;float: right" v-show="!value.collect"
                          @click="collect(value.id,key)"><icon name="heart-o" :scale="scale"></icon></span>
                    <span style="margin-right: 25px;float: right" v-show="value.collect"
                          @click="collect(value.id,key)"><icon name="heart" :scale="scale"></icon></span>

                </footer>
            </article>
        </section>
    </mt-search>
</template>

<script type="text/javascript">
    import Api from '@/api'
    export default {
        name: "Discover",
        data () {
            return {
                scale: 0.8,
                search: '',
                gifs: []
            }
        },
        methods: {
            imgObj: function (src) {
                return {
                    src: src,
                    error: require('@/assets/loading-spin.svg'),
                    loading: require('@/assets/loading-spin.svg'),
                }
            },
            changeSearchValue: function () {
                let _this = this;
                let keyword = this.$data.search;
                if (keyword != '') {
                    Api.search(keyword).then(function (response) {
                        _this.gifs = response.data.data;
                    }).catch(function (error) {
                        console.log({'search error': error})
                    })
                }

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
                if (_this.$data.gifs[key].support == value) {
                    return
                }
                if (_this.$data.gifs[key].support != 0) {
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
                if (_this.$data.gifs[key].support == value) {
                    return
                }
                if (_this.$data.gifs[key].support != 0) {
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
        }
    }

</script>

<style>
    .mint-search{
        height:100%
    }
    .discover{
        margin-top: 52px;
        margin-bottom: 55px;
    }
    .cont-li {
        border-top: #666666 1px solid;
    }

    .cont-li img[lazy=loading] {
        height: 68%;
        width: 100%;
    }

    .cont-li img[lazy=error] {
        height: 68%;
        width: 100%;
    }

    .cont-li img[lazy=loaded] {
        width: 100%;
    }

</style>