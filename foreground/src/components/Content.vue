<template>
    <section>
        <article class="content-up">
            <div class="content-up-main">
                <header>{{ gif.title }}</header>
                <img style="width: 100%" v-lazy="gif.url"/>
            </div>

            <footer class="content-up-footer">
                <span class="content-up-footer-comment">
                    <icon name="commenting"></icon>{{ gif.comments }}
                </span>

                <span class="content-up-footer-up" v-show="1==gif.support" @click="up(gif.id,1)">
                    <icon name="thumbs-up"></icon>{{ gif.up }}
                </span>
                <span class="content-up-footer-up" v-show="1!=gif.support" @click="up(gif.id,1)">
                    <icon name="thumbs-o-up"></icon>{{ gif.up }}
                </span>

                <span class="content-up-footer-down" v-show="2==gif.support" @click="down(gif.id,2)">
                    <icon name="thumbs-down"></icon>{{ gif.down }}
                </span>
                <span class="content-up-footer-down" v-show="2!=gif.support" @click="down(gif.id,2)">
                    <icon name="thumbs-o-down"></icon>{{ gif.down }}
                </span>

                <span class="content-up-footer-love" v-show="gif.collect" @click="collect(gif.id)">
                    <icon name="heart"></icon>
                </span>
                <span class="content-up-footer-love" v-show="!gif.collect" @click="collect(gif.id)">
                    <icon name="heart-o"></icon>
                </span>

            </footer>
        </article>
        <article class="content-center">
            <div class="content-center-header">
                <span @click="comment" v-show="show">
                    <icon name="send-o"></icon>发布
                </span>
                <span @click="toggleShow()" v-show="antishow">
                    <icon name="edit"></icon>点击评论
                </span>
            </div>
            <div class="content-center-text" v-show="show">
                <textarea placeholder="评论" v-model="content"></textarea>
            </div>
        </article>

        <article class="content-down">
            <h3>热门评论</h3>
            <div class="content-down-comments" v-for="item in comments">
                <div class="content-down-comments-up">
                    <span><img :src="item.user.avatar" style="border-radius: 10px;height: 20px"/></span>
                    <span class="content-down-comments-name">{{ item.user.name }}</span>
                    <span>{{ timeagoInstance.format(item.created_at, 'zh_CN') }}</span>
                    <!--<span style="float: right;margin-right: 15px;">
                        <icon name="thumbs-o-up"></icon>12
                    </span>
                    <span style="float: right;margin-right: 15px;">
                        <icon name="thumbs-o-down"></icon>8
                    </span>-->
                </div>
                <div class="content-down-comments-text">
                    <p>{{ item.content }} </p>
                </div>
            </div>

        </article>
    </section>

</template>

<script type="application/javascript">
    import Api from '@/api'
    import timeago from 'timeago.js';

    export default {
        name: "Content",
        data () {
            return {
                gif: {},
                comments: {},
                content: '',
                timeagoInstance: timeago(),
                show: false,
                img: 'https://tse3.mm.bing.net/th?id=OIP.hT034blVsi-A1ChdKgQM9gHaE-&pid=Api',
                src: 'https://wx.qlogo.cn/mmopen/vi_32/I36vsEtSvLWx0vklxNibNw0XuCyWBZWHBibPk25a4QvXZF8uhBTFh5eb2VbCFXWD9A8AAPl1mDWBRCGBBR1ojVEA/0'
            };
        },
        computed: {
            antishow: function () {
                return !this.show;
            }
        },
        created: function () {
            console.log(this.$route)
            let id = this.$route.query.id;
            if (id == undefined || isNaN(Number(id))) {
                this.$toast('参数错误');
                this.$router.go(-1);
            } else {
                this.loadGif(id);
                this.loadComments(id);
            }

        },
        methods: {
            toggleShow: function () {
                this.show = !this.show
            },
            comment: function () {
                let _this = this;
                let id = this.$route.query.id;

                Api.comment(id, this.content).then(function (response) {
                    _this.toggleShow();
                    _this.$toast({
                        message: '操作成功',
                        iconClass: 'icon icon-success'
                    });
                    _this.$data.gif.comments++;

                    let data = {content: _this.content, created_at: '刚刚', id: 0, user: {
                        id:_this.$store.state.id,
                        avatar:_this.$store.state.avatar,
                        email:_this.$store.state.email,
                        name:_this.$store.state.name,
                    }};
                    console.log({'comment data':data})
                    _this.$data.comments.unshift(data)

                }).catch(function (error) {
                    console.group({"comment error":error})
                    if (error.response.status == 401) {
                        _this.$toast("未登录授权");
                        _this.$router.push('login');
                    } else if (error.response.status == 422) {
                        for (var i in error.response.data.errors) {
                            let message = error.response.data.errors[i][0];
                            _this.$toast(message);
                            break;
                        }
                    }
                    else {
                        _this.$toast('网络错误')
                    }

                })
            },
            loadGif: function (id) {
                let _this = this;
                Api.gif(id).then(function (response) {
                    let data = response.data.data;
                    _this.gif = data;

                }).catch(function (error) {
                    _this.$toast('网络错误')
                })

            },
            loadComments: function (id) {
                let _this = this;
                Api.comments(id).then(function (response) {
                    let data = response.data.data;
                    _this.comments = data;

                }).catch(function (error) {
                    _this.$toast('评论加载失败')
                })
            },
            collect: function (gif_id) {
                let _this = this;
                _this.$data.gif.collect = !_this.$data.gif.collect;
                Api.collect(gif_id).then(function () {

                }).catch(function (error) {
                    if (error.response.status == 401) {
                        _this.$toast("未登录授权");
                        _this.$router.push('login');
                    }
                })
            },
            up: function (gif_id, value) {
                let _this = this;
                if (_this.$data.gif.support == value) {
                    return
                }
                if (_this.$data.gif.support != 0) {
                    _this.$data.gif.down--;
                }
                _this.$data.gif.up++;
                _this.$data.gif.support = value;
                Api.up(gif_id).then(function () {

                }).catch(function (error) {
                    if (error.response.status == 401) {
                        _this.$toast("未登录授权");
                        _this.$router.push('login');
                    }
                })
            },
            down: function (gif_id, value) {
                let _this = this;
                if (_this.$data.gif.support == value) {
                    return
                }
                if (_this.$data.gif.support != 0) {
                    _this.$data.gif.up--;
                }
                _this.$data.gif.down++;
                _this.$data.gif.support = value;
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

<style type="text/css">
    image[lazy=loading] {
        height: 200px;
        width: 100%;
        /*width: 40px;
        height: 300px;
        margin: auto;*/
    }

    .content-up {
    }

    .content-up .content-up-main {
    }

    .content-up .content-up-main header {
        padding: 8px 16px;
    }

    .content-up .content-up-main img {
        width: 100%
    }

    .content-up .content-up-footer {
        padding: 8px 16px;
    }

    .content-up .content-up-footer .content-up-footer-comment {
        margin-right: 35px;
    }

    .content-up .content-up-footer .content-up-footer-up {
        margin-right: 5px;
        float: right
    }

    .content-up .content-up-footer .content-up-footer-down {
        margin-right: 15px;
        float: right
    }

    .content-up .content-up-footer .content-up-footer-love {
        margin-right: 25px;
        float: right
    }

    .content-center {

    }

    .content-center .content-center-header {
        height: 30px;
    }

    .content-center .content-center-header span {
        float: left;
        line-height: 30px;
        text-align: center;
        margin-left: 12px;
        #margin-right: 21px
    }

    .content-center .content-center-text {
        height: 120px;
        margin: 0px 12px
    }

    .content-center .content-center-text textarea {
        width: 100%;
        height: 100%;
        border: 1px solid #aaa;
        resize: none;
    }

    .content-down {
        margin: 10px 12px 0 12px;
    }

    .content-down h3 {
        border-bottom: 1px solid #ce3d3a;
        color: #ce3d3a;
        padding: 6px 0;
    }

    .content-down .content-down-comments {
        margin: 10px 0px;
        #border: #aaa 1px solid;
    }

    .content-down .content-down-comments .content-down-comments-up {
        height: 30px;
        border-top: #f7e1b5 solid 1px;
    }

    .content-down .content-down-comments .content-down-comments-up span {
        height: 30px;
        line-height: 30px;
    }

    .content-down .content-down-comments .content-down-comments-name {
        color: #a5a4a4;
    }

    .content-down .content-down-comments .content-down-comments-text p {
        text-indent: 24px;
        line-height: 20px;
    }
</style>